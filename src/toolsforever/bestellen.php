<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        body{
            height: 100vh;
            width: 100vw;
            padding: 20px;
            overflow-X: hidden;
            
        }
        
        .bestellings-box{
            /* background-color: pink; */
            height: auto;
            width: auto;
            display: flex;
            justify-content: center;
        }
/* 
        .locatie-box{
            border: 1px solid black;
            padding: 20px;
        } */
        
        table{
            min-width: 800px;
        }
        table, th, td,thead,tbody,tr{
            border: 1px solid black;
            border-collapse: collapse;
        }

        td,th{
            padding: 10px;
        }

        button{
            padding: 10px;
            border-radius: 4px;
            background-color: black;
            color: white;
            border: 1px solid black;
        }

        .nieuweBestellingBtn{
            float: right;
        }
        .nieuweBestellingPopup{
            display: none;
            background-color: white;
            min-height: 500px;
            min-width: 700px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            z-index: 99;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 4;
        }
    </style>
</head>
<body>
    <header>
        <button onclick='location.href ="index.html"'>Home</button>
        <button class= "nieuweBestellingBtn">Nieuwe bestelling</button>
        <div class="nieuweBestellingPopup">
            <h1>Nieuwe Bestelling</h1>
            <label>Locatie</label>
            <select name="" id="">
            <option>Locatie</option>
            </select><br>
            <label>Besteldatum</label>
            <input type="date"><br>
            <label>Aankomstdatum</label>
            <input type="date"><br>
            <button>Plaats Bestelling</button>
        </div>
        <div class="overlay"></div>
    </header>


    <div class="bestellings-box"></div>
    <script>
        // drawAlleLocaties();
        AlleBestellingen();

        function AlleBestellingen(){
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                document.querySelector(".bestellings-box").innerHTML = xhr.responseText;
            }
            xhr.open("POST", "drawbestellingen.php");
            xhr.send();
        }


        // function drawAlleLocaties(){
        //     var xhr = new XMLHttpRequest();
        //         xhr.onload = function(){
        //             document.querySelector("SELECT").innerHTML = xhr.responseText;
        //         }
        //         xhr.open("POST", "locaties.php");
        //         xhr.send();
        // }

    const nieuweBestellingBtn = document.querySelector(".nieuweBestellingBtn");
    const nieuweBestellingsPoppupBox = document.querySelector(".nieuweBestellingPopup");
    const overlay = document.querySelector(".overlay");
    let BoxIsOpen = false;
    let canClose = true;

nieuweBestellingBtn.onclick = function(event){
    event.stopPropagation(); // Stop het event zodat het niet naar document.body gaat





    BoxIsOpen = true;
    nieuweBestellingsPoppupBox.style.display = "block";
    overlay.style.display = "block";
}

document.body.onclick = function(event) {
    // Check if waardeVoorraadBox is open and click is outside the popup box and button
    if (BoxIsOpen && canClose){
        
        overlay.style.display = "none";
        nieuweBestellingsPoppupBox.style.display = "none";
        BoxIsOpen = false;
    }
}

nieuweBestellingsPoppupBox.onmouseenter = function() {
    canClose = false;
};

nieuweBestellingsPoppupBox.onmouseleave = function() {
    canClose = true;
};
    </script>
</body>
</html>