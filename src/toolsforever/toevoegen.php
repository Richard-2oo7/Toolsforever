<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoegen/verwijderen</title>
    <style>
        body{
            padding: 10px;
            background-image: url("images/backgroundtoevoegen.png");
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;      
        }
        
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        h1{
            width: max-content;
        }

        .addProductBox {
            max-height: 600px;
            display: grid;
            column-gap: 200px;
            grid-template-columns: 1fr 1fr;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .productsbox{
            max-height: 520px;
            padding: 30px;
            background-color: white;
            min-width: 685px;
            max-width: 685px;
            /* width: min-content; */
            /* overflow: hidden; */
        }

        .productContent{
            display: grid;
            grid-template-columns: auto,auto;
        }

        .tabel-box {
            max-width: 700px;
            max-height: 400px;
            overflow-y: auto;
        }

        .tabel-box::-webkit-scrollbar {
            display: none; /* Verberg de standaard scrollbar voor webkit-browsers (zoals Chrome en Safari) */
        }

        .tabel-box {
            -ms-overflow-style: none; /* Verberg de standaard scrollbar voor IE/Edge */
            scrollbar-width: none; /* Verberg de standaard scrollbar voor Firefox */
            display: grid;
            grid-template-columns: auto auto;
        }

        .voorraadBox{
            /* overflow: hidden; */
            max-height: 600px;
            width: 450px;
            padding: 35px;
            background-color: white;
            grid-column: 2/2;
        }

        th,tr,td,table{
            width: max-content;
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            position: relative;
            top: 0;
            border-top: 1px solid black;
            background-color: white;
            z-index: 2; /* Zorg ervoor dat de sticky headers bovenaan blijven */
        }


        table{
            height: min-content;
            grid-column: 1/1;
        }
        .voorraadTabel{
            width: 380px;
        }

        select{
            padding: 10px;
            width: 100%;
            border: 1px;
        }

        select:active{
            outline: none;
        }

        select:focus{
            outline: none;
        }

        option:after{
            padding: 20px;
        }

        td{
            padding: 5px;
            height: 20px;
            width: min-content;
        }

        input{
            border: none;
            height: 100px;
        }

        .dataRow:hover{
            background: lightgray;
        }
        
        .editbtns{
            margin-left: auto;
            display: flex;
            align-self: flex-end;
            width: 100px;
            justify-content: space-between;
        }
        
       img{
        height: 20px;
       }

        .header{
            height: min-content;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .editProduct,.deleteProduct,.addProduct{
            height: 30px;
            width: 30px;
            display: flex;
            text-align: center;
            justify-content: center;
            padding: 4px;
            border-radius: 5px;
        } 
        
        .addProduct{
            border: 1px solid black;
            background: none;
        }

        .editProduct{
            border: none;
            background-color: lightgreen;
        }

        .deleteProduct{
            border: 1px solid black;
            background-color: red;
            border: none;
        }

        .addButton,.saveButton{
            grid-column: 2/2;
            height: 20px;
            padding: 5px;
            padding: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        button{
            padding: 10px;
            border-radius: 4px;
            background-color: black;
            color: white;
            border: 1px solid black;
        }

        .waardeVoorraadBtn{
            float: right;
        }

        .waardeVoorraadBox{
            /* display: none; */
            position: absolute;
            background-color: white;
            display: none;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 300px;
            min-height: 400px;
            z-index: 5;
            padding: 10px;
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
    <button onclick='location.href ="index.html"'>Home</button>
    <button class="waardeVoorraadBtn">Waarde voorraad</button>
    <div class= "waardeVoorraadBox">d</div>
    <div class="overlay"></div>

    <div class="addProductBox">
        <div class="productsbox">
            <div class="productContent">
                <div class="header">
                    <h1>Producten</h1>
                    <div class="editbtns">
                        <button class='addProduct'><img src='images/addicon.svg'></button>
                        <button class='editProduct'><img src='images/editicon.svg' class="editicon"></button>
                        <button class='deleteProduct'><img src='images/deleteicon.svg' class="deleteicon"></button>
                    </div>
                </div>
                <div class="tabel-box">
                    <table class="pruductTable"></table>
                </div>
            </div>
        </div>

        <div class="voorraadBox">
            <div class="voorraadContent">

                <div class="header">
                    <h1>Voorraad</h1>
                    <div class="editbtns">
                        <button class='addProduct'><img src='images/addicon.svg' id="voorraadAdd"></button>
                        <button class='editProduct'><img src='images/editicon.svg' class="editicon" id="voorraadEdit"></button>
                        <button class='deleteProduct'><img src='images/deleteicon.svg' class="deleteicon" id="voorraadDelete"></button>
                    </div>
                </div>
                <div class="tabel-box">
                    <table class="voorraadTabel"></table>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let waardeVoorraadBoxIsOpen = false;
        let canCloseWaardeVoorraadBoxPopup = true;

        const waardeVoorraadBox = document.querySelector(".waardeVoorraadBox");
        const overlay = document.querySelector(".overlay");
        document.body.onclick = function() {
            // Check if waardeVoorraadBox is open
            if (waardeVoorraadBoxIsOpen && canCloseWaardeVoorraadBoxPopup) {
                
                overlay.style.display = "none";
                waardeVoorraadBox.style.display = "none";
                // Update the state to reflect that waardeVoorraadBox is now closed
                waardeVoorraadBoxIsOpen = false;
            }
        }

        const waardeVoorraadBtn = document.querySelector(".waardeVoorraadBtn");
        waardeVoorraadBtn.onclick = function(event) {
            // Prevent the body click event from firing
            event.stopPropagation();
            waardeVoorraadBoxIsOpen = true;
            console.log("jajajajs");
            overlay.style.display = "inline"
            waardeVoorraadBox.style.display = "inline";
            SetWaardeVoorraadInBox();

        }
        waardeVoorraadBox.onmouseenter = function() {
            canCloseWaardeVoorraadBoxPopup = false;
        };

        waardeVoorraadBox.onmouseleave = function() {
            canCloseWaardeVoorraadBoxPopup = true;
        };
        function SetWaardeVoorraadInBox(){
            var xhr = new XMLHttpRequest();
                xhr.onload = function(){
                    waardeVoorraadBox.innerHTML = xhr.responseText;
                }
                xhr.open("POST", "waardeVoorraad.php",true);
                xhr.send();
        }




        drawProductTable();
        makeEmtpyTable();
        var a = 0;
        function makeEmtpyTable(){
            const table = document.querySelector(".pruductTable");
            const btn = document.querySelector(".addProduct");
            btn.onclick = function(){
                if(a == 0){
                    var row = table.insertRow(1);

                    for(var i =0; i < 6; i++){
                        var cell = row.insertCell(0);
                        if(i == 5){
                            cell.innerHTML = "-";
                        } else{
                            cell.contentEditable = true;
                            cell.classList.add("newCell");
                        }
                    }
                }

                const addBtn = document.createElement("BUTTON");
                if (a == 0) {
                    addBtn.innerHTML = "add";
                    addBtn.classList.add("addButton");
                    document.querySelector(".tabel-box").appendChild(addBtn);
                    a+=1;
                }
                addBtn.onclick = function(){
                    a-=1;
                    addProduct();
                    addBtn.remove();
                }
            }
        }
        function drawProductTable(){
            var xhr = new XMLHttpRequest();
                xhr.onload = function(){
                    document.querySelector(".pruductTable").innerHTML = xhr.responseText;
                }
                xhr.open("POST", "artikeltable.php",true);
                xhr.send();
        }

        function addProduct(){
            const dataCell = document.querySelectorAll(".newCell");
            const newProduct = [];

            dataCell.forEach((cell, index)=> {
                newProduct.push(cell.innerHTML);
            });

            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                drawProductTable()
                console.log("backendresponsetext: " + xhr.responseText);
            }
            xhr.open("POST", "voegDataToe.php",true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            console.log("frontend: " + newProduct);
            xhr.send("product=" + newProduct);        
        }


        const deleteBtn = document.querySelector(".deleteProduct");
        function deleteProduct(deletes){

            var trarr = document.querySelector(".pruductTable").querySelectorAll("tr");
            trarr.forEach(child =>{
                child.onmouseover = function(){
                    if(deletes){
                        child.style.background = "#F08784";             
                    }
                }
                console.log(child);
                child.onmouseout = function(){
                    child.style.background = "";
                }
                child.onclick = function(){
                    if(deletes){
                        var xhr = new XMLHttpRequest();
                        xhr.onload = function(){
                            DrawVoorraadTabel();
                            console.log(xhr.responseText);
                        }
                        xhr.open("POST","deleteProduct.php")
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("idartikel=" + child.firstChild.innerHTML)
                        child.remove();
                    }
                }
            })
        }

        var deletes = false;
        deleteBtn.onclick = function(){
            if(deletes){
                deletes = false;
            }else{
                deletes = true;
            }
            deleteProduct(deletes);
        };

        var edits = false;
        const editBtn = document.querySelector(".editProduct");
        editBtn.onclick = function(){
            if(edits){
                edits = false;
            }else{
                edits = true;
            }
            editProduct(edits);
        };

        function editProduct(edits){
            var trarr = document.querySelector(".pruductTable").querySelectorAll("tr");
            trarr.forEach(child=>{
                child.onmouseover = function(){
                    if(edits){
                        child.style.background = "lightgreen";
                    }
                }
                child.onmouseout = function(){
                    if(edits){
                        child.style.background = "";
                    }
                }
                child.onclick = function(){
                    if(edits){
                        edits = false;
                        child.style.background = "lightpink";

                        child.childNodes.forEach((cell, index) => {
                            if(index != 0 ){
                                cell.contentEditable = true;
                            }
                            
                        });


                        const saveChangesBtn = document.createElement("BUTTON");
                        saveChangesBtn.innerHTML = "Save";
                        saveChangesBtn.classList.add("saveButton");
                        document.querySelector(".productsbox").appendChild(saveChangesBtn);

                        saveChangesBtn.onclick = function(){
                            var gegevens = [];
                            child.childNodes.forEach(datacell=>{
                                gegevens.push(datacell.innerHTML);
                            });
                            console.log(gegevens);
                            var xmlrequest = new XMLHttpRequest();
                            xmlrequest.onload = function(){
                                DrawVoorraadTabel();
                                console.log(xmlrequest.responseText);
                                child.style.background = "";
                                child.childNodes.forEach(cell=>{
                                    cell.contentEditable = false;
                                });
                                saveChangesBtn.remove();
                            }
                            xmlrequest.open("POST", "editData.php");
                            xmlrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xmlrequest.send("product=" + gegevens);

                        }
                    }
                };
            });
        }
        const voorraadTabel = document.querySelector(".voorraadTabel");
        DrawVoorraadTabel();
        function DrawVoorraadTabel(){
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                voorraadTabel.innerHTML = xhr.responseText;
            }
            xhr.open("POST", "voorraadTabel.php");
            xhr.send();
        }


        const voorraadBox = document.querySelector(".voorraadBox");
        const voorraadAddBtn = document.getElementById("voorraadAdd");
        const voorraadEditBtn = document.getElementById("voorraadEdit");
        const voorraadDeleteBtn = document.getElementById("voorraadDelete");

        voorraadAddBtn.onclick = addVoorraad;
        voorraadEditBtn.onclick = editVoorraad;
        voorraadDeleteBtn.onclick = deleteVoorraad;

        var canAddVoorraad = true;
        function addVoorraad() {
            if (!canAddVoorraad) {
                return;
            }
            canAddVoorraad = false;

            const cellarr = [];
            var row = voorraadTabel.insertRow(1);
            for (var i = 0; i < 3; i++) {
                var cell = row.insertCell(0);
                cell.classList.add("newCell");
                cellarr.push(cell);
                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    cellarr[1].innerHTML = xhr.responseText;
                    var xml = new XMLHttpRequest();
                    xml.onload = function() {
                        cellarr[2].innerHTML = xml.responseText;
                    }
                    xml.open("POST", "artikelen.php");
                    xml.send();
                }
                xhr.open("POST", "locaties.php");
                xhr.send();
            }
            cellarr[0].innerHTML = "1";
            cellarr[0].contentEditable = "true";
            const addBtn = document.createElement("BUTTON");
            addBtn.innerHTML = "voegToe";
            addBtn.classList.add("addButton");
            voorraadBox.appendChild(addBtn)

            addBtn.onclick = function() {
                canAddVoorraad = true;

                const row = document.querySelectorAll(".newCell");
                const naam = row[0].querySelector("select").value;
                const locatie = row[1].querySelector("select").value;
                const aantal = row[2].innerHTML;

                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    DrawVoorraadTabel();
                    addBtn.remove();
                    console.log(xhr.responseText);
                }
                xhr.open("POST", "voegvoorraadtoe.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("naam=" + naam + "&locatie=" + locatie + "&aantal=" + aantal);
            }
        }

        let isVoorraadEditing = false;
        function editVoorraad() {
            let rowClickedOn = 0;
            var savebtn = document.createElement("BUTTON");
            isVoorraadEditing = !isVoorraadEditing;
            
            const allRows = document.querySelector(".voorraadTabel").querySelector("tbody").querySelectorAll("tr");
            

                allRows.forEach(row => {
                    
                    row.onmouseover = function() {
                        if (isVoorraadEditing) {
                        row.style.background = "lightgreen";
                        }
                    };
                    row.onmouseleave = function() {
                        if (isVoorraadEditing) {
                        row.style.background = "";
                        }
                    };

                    row.onclick = function(){
                        if (isVoorraadEditing) {
                            rowClickedOn = row;
                            row.style.background = "lightpink";
                            isVoorraadEditing = false;
                            childs = row.children;
                            childs[2].contentEditable = true;
                            savebtn.innerHTML = 'save';
                            document.querySelector(".voorraadContent").appendChild(savebtn);
                        }


                        }
                            savebtn.onclick = function(){

                            let productId = rowClickedOn.getAttribute('artikelid');
                            let locatieId = rowClickedOn.getAttribute('locatieid');
                            let aantal = childs[2].innerHTML;

                            let xhr = new XMLHttpRequest();
                            xhr.onload = function(){
                                console.log(xhr.responseText);
                                DrawVoorraadTabel();
                                savebtn.remove();

                            }
                            xhr.open("POST", "editvoorraad.php");
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.send("idArtikel=" + productId + "&idLocatie=" + locatieId + "&aantal=" + aantal);
                    }
                });
            }
        
        let isVoorraadDeleting = false;
        function deleteVoorraad(){
            isVoorraadDeleting == false ? isVoorraadDeleting = true : isVoorraadDeleting = false;
            const allRows = document.querySelector(".voorraadTabel").querySelector("tbody").querySelectorAll("tr");
                allRows.forEach(row => {
                    row.onmouseover = function() {
                        if (isVoorraadDeleting) {
                            row.style.background = "red";
                        }
                    };
                    row.onmouseleave = function() {
                        row.style.background = "";
                    };
                    row.onclick = function(){
                        if(isVoorraadDeleting){

                            var productId = row.getAttribute('artikelid');
                            var locatieId = row.getAttribute('locatieid');
                            console.log("productid: " + productId);
                            console.log("locatieid: " + locatieId);
                            
                            
                            var xhr = new XMLHttpRequest();
                            xhr.onload = function(){
                                DrawVoorraadTabel();
                                console.log(xhr.responseText);
                            }
                            xhr.open("POST", "verwijdervoorraad.php");
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.send("idArtikel=" + productId + "&idLocatie=" + locatieId);

                        }
                    }
                });
            }
    </script>
</body>
</html>