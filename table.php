<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <header>
            <h1>MSC Canteen LOL</h1>
        </header>
        <main id="main">
        </main>
        <script>
            for (let i = 1; i <= 5; i++) {
                const link = document.createElement('a');
                link.href = `http://localhost/orderSystem/index.php?table=${i}`;
                link.textContent = `Table ${i}`;
                document.getElementById('main').appendChild(link);
            }
        </script> 
    </body>
</html>