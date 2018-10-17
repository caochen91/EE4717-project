<!doctype html>
<html lang="en">
<head>
<title>JavaJam Coffee House</title> 

<meta charset=“utf-8”>
<link rel="stylesheet" href = "CSS/style.css">
    <style>
        .upDownButton{
            background:#ffd800;
            border:none;
            width:20px;
            color:#808080;
            margin: 1px 1px 1px 1px;
        }
        .qtyLabel {
            width: 20px;
            background: #ffffff;
            color: black;
            margin: 0 0 0 0;
            text-align: center;
            margin: 1px 1px 1px 1px;
        }
        .empty{
            visibility:collapse;
        }
        .updateCheckBox{
            background:#eaca8f;
        }

    </style>
    <?php 
        @ $db = new mysqli('localhost', 'f33ee', 'f33ee', 'f33ee');

        if (mysqli_connect_errno()) {
            echo 'Error: Could not connect to database.  Please try again later.';
            exit;
        }
        
        // for ($i=0; $i <$num_results; $i++) {
        //     $row = $result->fetch_assoc();
        // }
        //echo $temp;
        $data_col = array("productid", "name", "abbre_name", "price");
        $data_table = array(array());
        $query = "select * from products where 1;";
        $result = $db->query($query);

        $num_results = $result->num_rows;
        
        for($i=0; $i < $num_results; $i++){
            $row = $result ->fetch_assoc();
            $abbre_name = $row['abbre_name'];
            $data_table[$abbre_name] = $row;
        }

        $result->free();
        $db->close();

    ?>
    <script>
        var debug = true;
        var items = ["JJ", "CAL", "IC"];
        function onLoad() {
            for(var i =0; i< items.length; i++){
                document.getElementById('price' + items[i].toString()).parentElement.hidden = true;
                document.getElementById('checkbox' + items[i].toString()).checked = false;
                document.getElementById('checkbox' + items[i].toString()).value = false;
            }
            document.getElementById('CALsgl').checked = true;
            document.getElementById('ICsgl').checked = true;   
            console.log("Loading..");
        }
        function onUpdateCheckBoxChange(item){
            checkCondition = document.getElementById('checkbox'+item.toString()).checked;
            document.getElementById('checkbox'+item.toString()).value = checkCondition;
            //Hide the table column
            document.getElementById('price' + item.toString()).hidden = !checkCondition;
            document.getElementById('price' + item.toString()).parentElement.hidden = !checkCondition;
            //Todo: update prices
            //document.getElementById('price' + item.toString()).value = 
        }

        function debugPrint(on, string) {
            if (on) {
                console.log(string);
                //document.write(string);
            }
        }
        function radioButton(buttonName) {
            var button = document.getElementById(buttonName);
            var drink = (/[A-Z]+/).exec(buttonName);
            var sgldbl = (/[a-z]+/).exec(buttonName);//sgl-Single and dbl-Double
            //document.getElementById(drink + "sgl").checked = false;
            //document.getElementById(drink + "dbl").checked = false;

            //document.getElementsByName(buttonName).checked = true;

            debugPrint(debug, drink + sgldbl);
            if (sgldbl == "dbl") {
                document.getElementById(drink + "sgl").checked = false;
                document.getElementById(drink + "sgl").value = 0;
                document.getElementById(drink + "dbl").value = 1;
                debugPrint(debug, "dbl");
            }
            if (sgldbl == "sgl") {
                document.getElementById(drink + "dbl").checked = false;
                document.getElementById(drink + "dbl").value = 0;
                document.getElementById(drink + "sgl").value = 1;
                debugPrint(debug, "sgl");
            }
        }
    </script>


</head>
<div id="wrapper">
    <body onload = "onLoad()">      
        <header>
            <img src="javalogo.gif" height ="95em" width ="500em"></a>
        </header>
        <div>
            <nav>
                <ul >
                <li><a href = "index.html">Home </a> &nbsp </li>
                <li><a href = "admin.php" style="color:chocolate"> Price Update </a> &nbsp  </li>
                <li><a href = "sales.php" style="color:chocolate"> Sales </a> &nbsp  </li>
                </ul>
            </nav>
        </div>
        <div id="main_content">
        <div >
                <h1 id="title" > Click to update product prices: </h1>
        </div>
            <form method="post" action="updatePrice.php">
            <table id="menu_table">

                <tbody>
                    
                    <thead style="visibility:hidden">
                        <td> CheckBox</td>
                        <td> Coffee </td>
                        <td> Description</td>
                        <td> Value</td>
                    </thead>
                    <tr>
                        <td class="updateCheckBox"> 
                            <input id="checkboxJJ" name = "checkboxJJ" type="checkbox" onchange="onUpdateCheckBoxChange('JJ')"  />
                        </td>
                        <td> <strong> Just Java </strong> </td>
                        <td>
                            Regular hour blend, decaffeinated coffee, or flavor of the day.
                            <br> Endless Cup $<?php echo $data_table["JJ"]["price"];?>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input style="width:50px" type="number" id="priceJJ" name ="priceJJ"  step = "0.1" min ="0.1" max = "100">
                            <!-- <input type="hidden" name="abbrev_name" value="JJ"> -->
                        
                        </td>

                    </tr>
                    <tr>
                        <td class="updateCheckBox"> 
                            <input id="checkboxCAL" name="checkboxCAL" type="checkbox" onchange="onUpdateCheckBoxChange('CAL')"/>
                        </td>
                        <td> <strong> Cafe au Lait </strong> </td>
                        <td>
                            House blended coffee infused into a smooth, steamed milk.
                            <br> Single $<?php echo $data_table["CALsgl"]["price"];?> Double $<?php echo $data_table["CALdbl"]["price"];?>
                        </td>
                        <td>
                            <label for="CALsgl">Single</label>
                            <input type="radio" id="CALsgl" name="CALsgl" onClick="radioButton('CALsgl')" value = "1" />
                            <br />
                            <label for="CALdbl">Double</label>
                            <input type="radio" id="CALdbl"  name="CALdbl" onClick="radioButton('CALdbl')" value = "0"/>
                        </td>
 
                        <td>
                                <input style="width:50px" type="number" id="priceCAL"  name = "priceCAL" step="0.1" min ="0.1" max = "100">
                        </td>
                    </tr>
                    <tr>
                        <td class="updateCheckBox"> 
                            <input id="checkboxIC" name = "checkboxIC"type="checkbox" onchange="onUpdateCheckBoxChange('IC')"/>
                        </td>
                        <td><strong> Iced Cappucino </strong> </td>
                        <td>
                            Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                            <br> Single $<?php echo $data_table["ICsgl"]["price"];?> Double $<?php echo $data_table["ICdbl"]["price"];?>
                        </td>
                        <td>
                            <label for="ICsgl">Single</label>
                            <input type="radio" id="ICsgl" name="ICsgl" onClick="radioButton('ICsgl')" value = "1" />
                            <br />
                            <label for="ICdbl">Double</label>
                            <input type="radio" id="ICdbl" name="ICdbl"onClick="radioButton('ICdbl')" value = "0"/>
                        </td>
                        <td>
                            
                                <input style="width:50px" type="number" id="priceIC" name = "priceIC" step="0.1" min ="0.1" max = "100" >
                            </form>
                        </td>
                    </tr>
                    <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    
                    <td>
                    <input type="submit" />
                    </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </body >
    <footer>
        <p>
            <em> Copyright &copy 2014 JavaJam Coffee House </em>
            <br>
            <a href = "mailto:zhiwei@tan.com"><em> zhiwei@tan.com </em></a>
        </p>
    </footer>
</div>
</html>