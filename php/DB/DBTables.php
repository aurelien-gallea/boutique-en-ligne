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
                            `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'categories' => 'CREATE TABLE `categories` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` varchar(255) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',
            
            'products' => 'CREATE TABLE `products` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `name` varchar(255) NOT NULL,
                                `description` varchar(255) DEFAULT NULL,
                                `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'prod_cat' => 'CREATE TABLE `products_categories` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `product_id` INT NOT NULL,
                                `category_id` INT NULL,
                                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`),
                                FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

            'image' => 'CREATE TABLE `images` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `path` VARCHAR(255) NOT NULL,
                            `product_id` INT NOT NULL,
                            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

            'price' => 'CREATE TABLE `price` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `price` FLOAT NOT NULL, 
                            `product_id` INT NOT NULL,
                            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

            'color' => 'CREATE TABLE `color` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `color` varchar(255) NOT NULL,
                            `product_id` INT NOT NULL,
                            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

            'size' => 'CREATE TABLE `size` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `size` varchar(255) NOT NULL,
                            `color_id` INT NOT NULL,
                            FOREIGN KEY (`color_id`) REFERENCES `color`(`id`) ON DELETE CASCADE
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

            'stock' => 'CREATE TABLE `stock` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `quantity` INT NOT NULL,
                            `size_id` INT NOT NULL,
                            FOREIGN KEY (`size_id`) REFERENCES `size`(`id`) ON DELETE CASCADE
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;',

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
                                `address` varchar(255) NOT NULL,
                                `postalCode` int(11) NOT NULL,
                                `city` varchar(255) NOT NULL,
                                `country` varchar(255) NOT NULL,
                                `phone` varchar(80) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'cart' => 'CREATE TABLE `cart` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `quantity` INT NOT NULL,
                            `product_id` INT NOT NULL,
                            `color_id` INT NOT NULL,
                            `size_id` INT NOT NULL,
                            `price_id` INT NOT NULL,
                            `user_id` INT NOT NULL,
                            FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
                            FOREIGN KEY (`price_id`) REFERENCES `price`(`id`),
                            FOREIGN KEY (`size_id`) REFERENCES `size`(`id`),
                            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`),
                            FOREIGN KEY (`color_id`) REFERENCES `color`(`id`),
                            `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'orderDetails' => 'CREATE TABLE `orderdetails` (
                                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                                    `deliveryFullAddress` TEXT NOT NULL,
                                    `carriersDetails` TEXT NOT NULL,
                                    `carriers_price` FLOAT NOT NULL,
                                    `product_ids` TEXT NOT NULL,
                                    `color_ids` TEXT NOT NULL,
                                    `size_ids` TEXT NOT NULL,
                                    `product_names` TEXT NOT NULL,
                                    `color_names` TEXT NOT NULL,
                                    `size_names` TEXT NOT NULL,
                                    `price_values` TEXT NOT NULL,
                                    `quantity` INT NOT NULL,
                                    `total_amount` FLOAT NOT NULL,
                                    `user_id` INT NOT NULL,
                                    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
                                    `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
                                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',

            'orderFinal' => 'CREATE TABLE `orderfinal` (
                                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                                    `deliveryFullAddress` TEXT NOT NULL,
                                    `carriersDetails` TEXT NOT NULL,
                                    `carriers_price` FLOAT NOT NULL,
                                    `product_ids` TEXT NOT NULL,
                                    `color_ids` TEXT NOT NULL,
                                    `size_ids` TEXT NOT NULL,
                                    `product_names` TEXT NOT NULL,
                                    `color_names` TEXT NOT NULL,
                                    `size_names` TEXT NOT NULL,
                                    `price_values` TEXT NOT NULL,
                                    `quantity` INT NOT NULL,
                                    `total_amount` FLOAT NOT NULL,
                                    `payement_status` BOOLEAN NOT NULL,
                                    `user_id` INT NOT NULL,
                                    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
                                    `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
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
                    // echo "Erreur lors de la création de la table '$tableName': " . $e->getMessage() . PHP_EOL;
                }
            } else {
                // echo "La table '$tableName' existe déjà." . PHP_EOL;
            }
        }

?>