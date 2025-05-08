<?
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, rgba(85, 110, 130, 0.7), rgba(192, 123, 77, 0.7)), url('images/hotel-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        header, footer {
            background-color: rgba(62, 39, 35, 0.8);
            color: white;
            text-align: center;
            padding: 20px;
        }
        nav {
            background-color: rgba(93, 64, 55, 0.9);
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 1.2em;
            cursor: pointer;
            padding: 10px 15px;
        }
        nav a:hover {
            background-color: rgba(192, 123, 77, 0.8);
            text-decoration: underline;
        }
        .room-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            padding: 40px;
        }
        .room-item {
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            margin-top: 20px;
            transition: transform 0.3s ease;
        }
        .room-item img {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-bottom: 1px solid #ccc;
        }
        .room-item h3 {
            background-color: #f4f4f4;
            margin: 0;
            padding: 10px 0;
            font-size: 1.4em;
            color: #3e2723;
        }
        .room-item:hover {
            transform: scale(1.05);
        }
        section {
            margin-top: 60px;
        }
        .welcome-text h1, .welcome-text h2 {
            font-family: 'Georgia', serif;
        }
        .best-seller {
            font-style: italic;
            text-align: center;
            margin-top: 50px;
            font-size: 2em;
        }
        footer {
            margin-top: 40px;
            font-size: 1.1em;
        }
        .welcome-text {
            text-align: center;
            padding: 50px 20px;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
        }
        .welcome-text h1, .welcome-text h2 {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <header>
        <h1>Grand Stay Hotel</h1>
    </header>
    <nav>
        <a href="#rooms" data-target="rooms">Rooms</a>
        <a href="#book-now" data-target="book-now">Book Now</a>
        <a href="#location" data-target="location">Location</a>
        <a href="#about-us" data-target="about-us">About Us</a>
        <a href="./logout.php"><button class="logout-button" >Log Out</button></a>
    </nav>
    <div class="welcome-text">
        <h1><b>Welcome to Grand Stay Hotel</b></h1>
        <h2>Your Perfect Stay Awaits</h2>
    </div>
    <h1 class="best-seller">Our Best Rooms</h1>
    <section class="room-gallery">
        <div class="room-item">
            <img src="./images/deluxe-room-king-1-2000px.jpg" alt="Deluxe Room">
            <h3>Deluxe Room</h3>
        </div>
        <div class="room-item">
            <img src="./images/Hotel-suite-living-room.jpg" alt="Suite Room">
            <h3>Suite Room</h3>
        </div>
        <div class="room-item">
            <img src="./images/Amorgos-Standard-Room2-e1464286437370.jpg" alt="Standard Room">
            <h3>Standard Room</h3>
        </div>
        <div class="room-item">
            <img src="./images/Penthouse-Suite-Bedroom_2.jpg" alt="Penthouse">
            <h3>Penthouse</h3>
        </div>
        <div class="room-item">
            <img src="./images/A3_5-1-1024x680 (1).jpg" alt="Villa">
            <h3>Villa</h3>
        </div>
        <div class="room-item">
            <img src="./images/Family-Suite1-850x450.jpg" alt="Family Suite">
            <h3>Family Suite</h3>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Grand Stay Hotel. All rights reserved.</p>
    </footer>
</body>
</html>
