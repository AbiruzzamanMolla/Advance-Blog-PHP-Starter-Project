<?

$sql = "--\n"

    . "-- Database: `id231601_cms`\n"

    . "--\n"

    . "\n"

    . "-- --------------------------------------------------------\n"

    . "\n"

    . "--\n"

    . "-- Table structure for table `categories`\n"

    . "--\n"

    . "\n"

    . "CREATE TABLE `categories` (\n"

    . "  `cat_id` int(11) NOT NULL,\n"

    . "  `cat_title` varchar(255) NOT NULL,\n"

    . "  `cat_image` varchar(255) NOT NULL DEFAULT \'no_category.png\'\n"

    . ") ENGINE=InnoDB DEFAULT CHARSET=latin1";
    
    ?>