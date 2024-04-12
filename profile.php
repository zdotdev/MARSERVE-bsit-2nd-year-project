<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Style/profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Contact Us</title>
</head>
<body>
    <header>
        <h1>MARSERVE</h1>
    </header>
    <button id="home" class="material-symbols-outlined arrow">arrow_back</button>
    <main>
        <strong class='head-title'>Seeking guidance? Our team is here to lend a hand</strong>
        <section>
            <img src="./Image/mirel.jpg" alt="marielle smthng" class="profile-image">
            <h2><strong>Mirelle Lynch R. Paez</strong></h2>
            <hr>
            <p>Contact Information:</p>
            <p><strong>Phone No.: </strong>09123456789</p>
            <p><strong>Email: </strong>paezmirellelynch@gmail.com</p>
            <p><strong>Social Media Links: </strong>https://web.facebook.com/mirelle.paez038</p>
            <p><strong>Address: </strong>Landy, Santa Cruz, Marinduque</p>
        </section>
        <section>
            <img src="./Image/toni.jpg" alt="diane smthng" class="profile-image">
            <h2><strong>Diane Cyridel D. Cabillos</strong></h2>
            <hr>
            <p>Contact Information:</p>
            <p><strong>Phone No.: </strong>09123456789</p>
            <p><strong>Email: </strong>dianediane@gmail.com</p>
            <p><strong>Social Media Links: </strong>https://web.facebook.com/diane069</p>
            <p><strong>Address: </strong>Bagong Silang, Santa Cruz, Marinduque</p>
        </section>
    </main>
    <script>
        document.getElementById('home').addEventListener('click', () => {
            let currentUrl = window.location.href
            let url = new URL(currentUrl)
            let oi = url.searchParams.get('orderId')
            let table = url.searchParams.get('table')
            if(oi) {
                window.location.href = `http://localhost/orderSystem/index.php?orderId=${oi}&table=${table}`
            } else{
            window.location.href = `http://localhost/orderSystem/index.php?table=${table}`
            }
            })
    </script>
</body>
</html>