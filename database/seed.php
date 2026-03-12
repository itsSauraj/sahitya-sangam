<?php
/**
 * Database Seeder
 * 
 * Usage: php database/seed.php
 */

require_once __DIR__ . '/../includes/config/init.php';

class DatabaseSeeder {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Seed sample books
     */
    public function seedBooks() {
        echo "Seeding books...\n";
        
        $books = [
            [
                'title' => 'The Great Indian Novel',
                'author' => 'Shashi Tharoor',
                'isbn' => '9780140277418',
                'description' => 'A satirical novel using the narrative framework of the Mahabharata to chronicle modern Indian history.',
                'price' => 450.00,
                'stock' => 25,
                'category' => 'Fiction',
                'publisher' => 'Penguin Books',
                'published_year' => 1989,
                'language' => 'English',
                'pages' => 419
            ],
            [
                'title' => 'Midnight\'s Children',
                'author' => 'Salman Rushdie',
                'isbn' => '9780099578512',
                'description' => 'A novel about India\'s transition from British colonialism to independence.',
                'price' => 550.00,
                'stock' => 30,
                'category' => 'Fiction',
                'publisher' => 'Vintage',
                'published_year' => 1981,
                'language' => 'English',
                'pages' => 647
            ],
            [
                'title' => 'The God of Small Things',
                'author' => 'Arundhati Roy',
                'isbn' => '9780006550686',
                'description' => 'A story about the childhood experiences of fraternal twins.',
                'price' => 399.00,
                'stock' => 40,
                'category' => 'Fiction',
                'publisher' => 'IndiaInk',
                'published_year' => 1997,
                'language' => 'English',
                'pages' => 340
            ],
            [
                'title' => 'Train to Pakistan',
                'author' => 'Khushwant Singh',
                'isbn' => '9780140255928',
                'description' => 'A historical novel set in the Partition of India.',
                'price' => 350.00,
                'stock' => 20,
                'category' => 'Historical Fiction',
                'publisher' => 'Penguin Books',
                'published_year' => 1956,
                'language' => 'English',
                'pages' => 181
            ],
            [
                'title' => 'The White Tiger',
                'author' => 'Aravind Adiga',
                'isbn' => '9781416562603',
                'description' => 'A darkly humorous perspective on India\'s class struggle.',
                'price' => 425.00,
                'stock' => 35,
                'category' => 'Fiction',
                'publisher' => 'Free Press',
                'published_year' => 2008,
                'language' => 'English',
                'pages' => 276
            ]
        ];
        
        $stmt = $this->conn->prepare(
            "INSERT INTO books (title, author, isbn, description, price, stock, category, publisher, published_year, language, pages) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        
        $count = 0;
        foreach ($books as $book) {
            $stmt->bind_param(
                "ssssdissiis",
                $book['title'],
                $book['author'],
                $book['isbn'],
                $book['description'],
                $book['price'],
                $book['stock'],
                $book['category'],
                $book['publisher'],
                $book['published_year'],
                $book['language'],
                $book['pages']
            );
            
            if ($stmt->execute()) {
                $count++;
                echo "  ✓ Added: {$book['title']}\n";
            }
        }
        
        echo "✓ Seeded {$count} books\n\n";
    }
    
    /**
     * Seed sample authors
     */
    public function seedAuthors() {
        echo "Seeding authors...\n";
        
        $authors = [
            [
                'name' => 'Rabindranath Tagore',
                'bio' => 'Bengali polymath who reshaped Bengali literature and music, and became the first non-European to win the Nobel Prize in Literature in 1913.',
                'birth_date' => '1861-05-07',
                'death_date' => '1941-08-07',
                'nationality' => 'Indian'
            ],
            [
                'name' => 'R.K. Narayan',
                'bio' => 'Indian writer known for his works set in the fictional South Indian town of Malgudi.',
                'birth_date' => '1906-10-10',
                'death_date' => '2001-05-13',
                'nationality' => 'Indian'
            ],
            [
                'name' => 'Amitav Ghosh',
                'bio' => 'Indian writer best known for his work in English fiction.',
                'birth_date' => '1956-07-11',
                'death_date' => NULL,
                'nationality' => 'Indian'
            ],
            [
                'name' => 'Vikram Seth',
                'bio' => 'Indian novelist and poet known for his epic novel "A Suitable Boy".',
                'birth_date' => '1952-06-20',
                'death_date' => NULL,
                'nationality' => 'Indian'
            ],
            [
                'name' => 'Jhumpa Lahiri',
                'bio' => 'British-American author known for her short stories and novels that examine the immigrant experience.',
                'birth_date' => '1967-07-11',
                'death_date' => NULL,
                'nationality' => 'American'
            ]
        ];
        
        $stmt = $this->conn->prepare(
            "INSERT INTO authors (name, bio, birth_date, death_date, nationality) 
             VALUES (?, ?, ?, ?, ?)"
        );
        
        $count = 0;
        foreach ($authors as $author) {
            $stmt->bind_param(
                "sssss",
                $author['name'],
                $author['bio'],
                $author['birth_date'],
                $author['death_date'],
                $author['nationality']
            );
            
            if ($stmt->execute()) {
                $count++;
                echo "  ✓ Added: {$author['name']}\n";
            }
        }
        
        echo "✓ Seeded {$count} authors\n\n";
    }
    
    /**
     * Seed test user
     */
    public function seedTestUser() {
        echo "Seeding test user...\n";
        
        $name = "Test User";
        $email = "test@sahityasangam.com";
        $password = password_hash("password123", PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            echo "  ✓ Created test user\n";
            echo "    Email: {$email}\n";
            echo "    Password: password123\n";
        }
        
        echo "\n";
    }
    
    /**
     * Run all seeders
     */
    public function run() {
        echo "\n";
        echo str_repeat('=', 50) . "\n";
        echo "Database Seeder\n";
        echo str_repeat('=', 50) . "\n\n";
        
        try {
            $this->seedAuthors();
            $this->seedBooks();
            $this->seedTestUser();
            
            echo str_repeat('=', 50) . "\n";
            echo "✓ Seeding completed successfully!\n";
            echo str_repeat('=', 50) . "\n\n";
        } catch (Exception $e) {
            echo "\n✗ Seeding failed: " . $e->getMessage() . "\n\n";
            exit(1);
        }
    }
}

// CLI Handler
if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.\n");
}

$seeder = new DatabaseSeeder($conn);
$seeder->run();
