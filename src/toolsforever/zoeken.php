<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    </style>
    <style>
        table, td, tr, th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        button{
            padding: 10px;
            border-radius: 4px;
            background-color: black;
            color: white;
            border: 1px solid black;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .zoek-filter{
            
            background-color: lightgray;
            padding: 20px;
            border-radius: 20px;
            display: flex;
            width: auto;
            justify-content: center;
            margin-bottom: 20px;
        }
        body{
            display:flex;
            justify-content: center;

        }
        .content{
            display: grid;
            width: 900px;
        }
        select,input{
            padding: 10px;
        }
    </style>
</head>
<body>
    <button onclick='location.href ="index.html"'>Home</button>
    <div class="content">
    <div class="zoek-filter">
        <form action="" method="post" id="filterform">
        <select name="locatie">
            <option value="">Locatie</option>
            <script>
            var xhr = new XMLHttpRequest();
                xhr.onload = function(){
                    document.querySelector("SELECT").innerHTML =xhr.responseText;
                }
                xhr.open("POST", "locaties.php");
                xhr.send();

        </script>
        </select>
        <input type ="tekst" placeholder="Productnaam" name="nameProduct" id="productInput">
        </form>
    </div>
    <table id="table">
<!-- filter tabel -->
            <script>
                const selectbox = document.querySelector("select");
                function loadTable(formdata){

                    var xhr = new XMLHttpRequest();
                    xhr.onload = function(){
                        document.querySelector("#table").innerHTML = xhr.responseText;
                    }
                    xhr.open("POST", "drawTable.php");
                    xhr.send(formdata);
                }
                function sendData(){
                    const form = document.getElementById("filterform");
                    const formdata = new FormData(form); // Haal formuliergegevens op
                    loadTable(formdata);
                }

                document.getElementById("productInput").addEventListener("input", sendData);
                selectbox.addEventListener('change', sendData);
                loadTable();
            </script>
</table>
</div>
</body>
</html>
