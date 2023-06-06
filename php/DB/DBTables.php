<?php
require_once('php/DB/DBManager.php');

        $tables = [
            'user' => 'CREATE TABLE `user` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `email` varchar(255) NOT NULL UNIQUE,
                            `password` varchar(255) NOT NULL,
                            `firstname` varchar(255) NOT NULL,
                            `lastname` varchar(255) NOT NULL,
                            `role` varchar(80) NOT NULL,
                            `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'categories' => 'CREATE TABLE `categories` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` varchar(255) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',
            
            'products' => 'CREATE TABLE `products` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` varchar(255) NOT NULL,
                                `description` varchar(255) DEFAULT NULL,
                                `subDesc` varchar(255) DEFAULT NULL,
                                `img` varchar(255) DEFAULT NULL,
                                `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
                                `quantity` int(11) DEFAULT NULL,
                                `price` float DEFAULT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'images' => 'CREATE TABLE `images` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `name` VARCHAR(255) NOT NULL,
                            `product_id` INT NOT NULL,
                            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'prod_cat' => 'CREATE TABLE `products_categories` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `product_id` INT NOT NULL,
                                `category_id` INT NOT NULL,
                                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`),
                                FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

            'options' => 'CREATE TABLE `productsOptions` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` VARCHAR(80) NOT NULL,
                                `value` VARCHAR(80) NOT NULL,
                                `quantity` INT(11) DEFAULT NULL,
                                `price` FLOAT DEFAULT NULL,
                                `product_id` INT NOT NULL,
                                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'carriers' => 'CREATE TABLE `carriers` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` varchar(80) NOT NULL,
                                `description` varchar(255) NOT NULL,
                                `price` float NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
            

            'delivery' => 'CREATE TABLE `delivery` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` varchar(255) NOT NULL,
                                `firstname` varchar(255) NOT NULL,
                                `lastname` varchar(255) NOT NULL,
                                `adress` varchar(255) NOT NULL,
                                `postalCode` int(11) NOT NULL,
                                `city` varchar(255) NOT NULL,
                                `country` varchar(255) NOT NULL,
                                `phone` varchar(80) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'order_details' => 'CREATE TABLE `order_details` (
                                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                                    `cart_id` INT NOT NULL,
                                    `delivery_full_address` TEXT NOT NULL,
                                    `date_creation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    FOREIGN KEY (`cart_id`) REFERENCES `cart`(`id`)
                                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
            
            'order' => 'CREATE TABLE `order` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `order_details_id` INT NOT NULL,
                            `status` VARCHAR(255) NOT NULL,
                            FOREIGN KEY (`order_details_id`) REFERENCES `order_details`(`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'cart' => 'CREATE TABLE `cart` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
                            `quantity` int(11) DEFAULT NULL,
                            `price` float DEFAULT NULL,
                            `user_id` int(11) NOT NULL,
                            FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
            
        ];

        foreach($tables as $tableName => $createQuery){
            $stmt = $bdd->query("SHOW TABLES LIKE '" . strtolower($tableName) . "'");
            $tableExists = $stmt->rowCount() > 0;

            if (!$tableExists) {
                try {
                    $bdd->exec($createQuery);
                    echo "La table '$tableName' a été créée." . PHP_EOL;
                } catch (PDOException $e) {
                    echo "Erreur lors de la création de la table '$tableName': " . $e->getMessage() . PHP_EOL;
                }
            } else {
                echo "La table '$tableName' existe déjà." . PHP_EOL;
            }
        }

?>