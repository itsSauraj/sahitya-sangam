<?php
/**
 * Database Migration Runner
 * 
 * Usage:
 *   php database/migrate.php up           # Run all pending migrations
 *   php database/migrate.php down         # Rollback last migration
 *   php database/migrate.php down 3       # Rollback last 3 migrations
 *   php database/migrate.php status       # Show migration status
 *   php database/migrate.php create TableName  # Create new migration file
 */

require_once __DIR__ . '/../includes/config/init.php';

class MigrationRunner {
    private $conn;
    private $migrationsPath;
    
    public function __construct($conn) {
        $this->conn = $conn;
        $this->migrationsPath = __DIR__ . '/migrations/';
        $this->ensureMigrationsTable();
    }
    
    /**
     * Create migrations tracking table if it doesn't exist
     */
    private function ensureMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            migration VARCHAR(255) NOT NULL UNIQUE,
            batch INT NOT NULL,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (!$this->conn->query($sql)) {
            die("Error creating migrations table: " . $this->conn->error);
        }
    }
    
    /**
     * Get all migration files
     */
    private function getMigrationFiles() {
        $files = glob($this->migrationsPath . '*.sql');
        sort($files);
        return array_map('basename', $files);
    }
    
    /**
     * Get executed migrations from database
     */
    private function getExecutedMigrations() {
        $result = $this->conn->query("SELECT migration FROM migrations ORDER BY id");
        $executed = [];
        while ($row = $result->fetch_assoc()) {
            $executed[] = $row['migration'];
        }
        return $executed;
    }
    
    /**
     * Get pending migrations
     */
    private function getPendingMigrations() {
        $all = $this->getMigrationFiles();
        $executed = $this->getExecutedMigrations();
        return array_diff($all, $executed);
    }
    
    /**
     * Get next batch number
     */
    private function getNextBatch() {
        $result = $this->conn->query("SELECT MAX(batch) as max_batch FROM migrations");
        $row = $result->fetch_assoc();
        return ($row['max_batch'] ?? 0) + 1;
    }
    
    /**
     * Parse migration file and extract UP/DOWN sections
     */
    private function parseMigrationFile($filename) {
        $content = file_get_contents($this->migrationsPath . $filename);
        
        // Extract UP section
        preg_match('/-- UP\s*\n(.*?)-- DOWN/s', $content, $upMatches);
        $up = trim($upMatches[1] ?? '');
        
        // Extract DOWN section
        preg_match('/-- DOWN\s*\n(.*?)$/s', $content, $downMatches);
        $down = trim($downMatches[1] ?? '');
        
        return ['up' => $up, 'down' => $down];
    }
    
    /**
     * Execute multiple SQL statements
     */
    private function executeStatements($sql) {
        // Split by semicolon but keep SQL intact
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            function($stmt) { return !empty($stmt); }
        );
        
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                if (!$this->conn->query($statement)) {
                    throw new Exception("SQL Error: " . $this->conn->error . "\nStatement: " . $statement);
                }
            }
        }
    }
    
    /**
     * Run migrations UP
     */
    public function up() {
        $pending = $this->getPendingMigrations();
        
        if (empty($pending)) {
            echo "✓ No pending migrations.\n";
            return;
        }
        
        $batch = $this->getNextBatch();
        echo "Running " . count($pending) . " migration(s)...\n\n";
        
        foreach ($pending as $migration) {
            try {
                echo "→ Migrating: {$migration}\n";
                
                $parsed = $this->parseMigrationFile($migration);
                $this->executeStatements($parsed['up']);
                
                // Record migration
                $stmt = $this->conn->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");
                $stmt->bind_param("si", $migration, $batch);
                $stmt->execute();
                
                echo "✓ Migrated:  {$migration}\n\n";
            } catch (Exception $e) {
                echo "✗ Failed:    {$migration}\n";
                echo "  Error: " . $e->getMessage() . "\n\n";
                exit(1);
            }
        }
        
        echo "✓ All migrations completed successfully!\n";
    }
    
    /**
     * Rollback migrations DOWN
     */
    public function down($steps = 1) {
        // Get last batch
        $result = $this->conn->query(
            "SELECT DISTINCT batch FROM migrations ORDER BY batch DESC LIMIT " . (int)$steps
        );
        
        $batches = [];
        while ($row = $result->fetch_assoc()) {
            $batches[] = $row['batch'];
        }
        
        if (empty($batches)) {
            echo "✓ Nothing to rollback.\n";
            return;
        }
        
        // Get migrations to rollback
        $batchList = implode(',', $batches);
        $result = $this->conn->query(
            "SELECT migration FROM migrations WHERE batch IN ($batchList) ORDER BY id DESC"
        );
        
        $migrations = [];
        while ($row = $result->fetch_assoc()) {
            $migrations[] = $row['migration'];
        }
        
        echo "Rolling back " . count($migrations) . " migration(s)...\n\n";
        
        foreach ($migrations as $migration) {
            try {
                echo "→ Rolling back: {$migration}\n";
                
                $parsed = $this->parseMigrationFile($migration);
                if (empty($parsed['down'])) {
                    echo "  Warning: No DOWN section found, skipping.\n\n";
                    continue;
                }
                
                $this->executeStatements($parsed['down']);
                
                // Remove from migrations table
                $stmt = $this->conn->prepare("DELETE FROM migrations WHERE migration = ?");
                $stmt->bind_param("s", $migration);
                $stmt->execute();
                
                echo "✓ Rolled back: {$migration}\n\n";
            } catch (Exception $e) {
                echo "✗ Failed:      {$migration}\n";
                echo "  Error: " . $e->getMessage() . "\n\n";
                exit(1);
            }
        }
        
        echo "✓ Rollback completed successfully!\n";
    }
    
    /**
     * Show migration status
     */
    public function status() {
        $all = $this->getMigrationFiles();
        $executed = $this->getExecutedMigrations();
        $pending = $this->getPendingMigrations();
        
        echo "Migration Status:\n";
        echo str_repeat('=', 70) . "\n\n";
        
        if (!empty($executed)) {
            echo "Executed Migrations:\n";
            foreach ($executed as $migration) {
                echo "  ✓ {$migration}\n";
            }
            echo "\n";
        }
        
        if (!empty($pending)) {
            echo "Pending Migrations:\n";
            foreach ($pending as $migration) {
                echo "  • {$migration}\n";
            }
            echo "\n";
        }
        
        echo str_repeat('=', 70) . "\n";
        echo "Total: " . count($all) . " | Executed: " . count($executed) . " | Pending: " . count($pending) . "\n";
    }
    
    /**
     * Create new migration file
     */
    public function create($name) {
        $timestamp = date('YmdHis');
        $filename = "{$timestamp}_{$name}.sql";
        $filepath = $this->migrationsPath . $filename;
        
        $template = "-- Migration: {$name}
-- Created: " . date('Y-m-d H:i:s') . "

-- UP
-- Write your UP migration here (CREATE, ALTER, INSERT, etc.)



-- DOWN
-- Write your DOWN migration here (DROP, ALTER to revert, DELETE, etc.)

";
        
        file_put_contents($filepath, $template);
        echo "✓ Created migration: {$filename}\n";
        echo "  Path: {$filepath}\n";
    }
}

// CLI Handler
if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.\n");
}

$command = $argv[1] ?? 'status';
$runner = new MigrationRunner($conn);

switch ($command) {
    case 'up':
        $runner->up();
        break;
        
    case 'down':
        $steps = isset($argv[2]) ? (int)$argv[2] : 1;
        $runner->down($steps);
        break;
        
    case 'status':
        $runner->status();
        break;
        
    case 'create':
        if (!isset($argv[2])) {
            die("Usage: php migrate.php create MigrationName\n");
        }
        $runner->create($argv[2]);
        break;
        
    default:
        echo "Unknown command: {$command}\n\n";
        echo "Available commands:\n";
        echo "  up              Run all pending migrations\n";
        echo "  down [steps]    Rollback last migration(s)\n";
        echo "  status          Show migration status\n";
        echo "  create <name>   Create new migration file\n";
        break;
}
