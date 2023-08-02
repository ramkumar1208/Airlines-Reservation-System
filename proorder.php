<html>
<style>
                    .btn-minus, .btn-plus {
                            width: 40px;
                            height: 40px;
                            font-size: 20px;
                            font-weight: bold;
                            border: 1px solid #ddd;
                            border-radius: 50%;
                            display: inline-block;
                            text-align: center;
                            cursor: pointer;
                        }

                        input[type="text"] {
                            width: 60px;
                            height: 40px;
                            text-align: center;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            font-size: 20px;
                        }

                        button[name="order"] {
                            width: 150px;
                            height: 40px;
                            font-size: 20px;
                            font-weight: bold;
                            background-color: #ddd;
                            border: 1px solid #333;
                            border-radius: 5px;
                            cursor: pointer;
                        }                        
                        button[name="addToCart"] {
                            width: 150px;
                            height: 40px;
                            font-size: 20px;
                            font-weight: bold;
                            background-color: #ddd;
                            border: 1px solid #333;
                            border-radius: 5px;
                            cursor: pointer;
                        }
         </style>
                             <script>
                    document.getElementById("order").addEventListener("click", function() {
                    var quant = document.getElementById("quant").value;
                    var totalAmount = document.getElementById("totalAmount").value;
                    window.location.href = "order2.php?quant=" + quant + "&amount=" + totalAmount + "&name= <?php echo $row['product_name']; ?>";
                    });
                    </script>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <script>
                        var price = <?php echo $row['amount']; ?>;
                        function incrementValue(id) {
                        var input = document.getElementById(id);
                        input.value = parseInt(input.value) + 1;
                        updateAmount();
                        }

                        function decrementValue(id) {
                        var input = document.getElementById(id);
                        if (input.value > 0) {
                            input.value = parseInt(input.value) - 1;
                            updateAmount();
                        }
                        }

                        function updateAmount() {
                        var totalAmount = document.getElementById("totalAmount");
                        var quant = document.getElementById("quant").value;
                        totalAmount.value = quant * price;
                        }
                        </script>

<body>
         <script>
            function increaseItem(item,price) {
    var itemQuantity = document.getElementById(item);
    var itemPrice = document.getElementById(price);
            
    itemQuantity.value = parseInt(itemQuantity.value) + 1;
    itemPrice.innerHTML = parseInt(itemPrice.innerHTML) + parseInt(itemQuantity.value);
}

function decreaseItem(item, price) {
    var itemQuantity = document.getElementById(item);
    var itemPrice = document.getElementById(price);

    if (itemQuantity.value > 0) {
        itemQuantity.value = parseInt(itemQuantity.value) - 1;
        itemPrice.innerHTML = parseInt(itemPrice.innerHTML) - parseInt(itemQuantity.value);
    }
}
  </script>
    </body>
</html>
<?php
include 'db.php';
if (isset($_GET['proname'])) {
  $proname = $_GET['proname'];

} else {
  echo "please select product";
}
 //$conn = mysqli_connect("localhost", "root", "", "phplogin");
    
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the product images and details from the database
    $query = "SELECT * FROM products where `product_name`='$proname'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results
        echo '<html>
        <body>
        <style>
        table {
          border-collapse: collapse;
          width: 80%;
          margin: auto;
          text-align: center;
          font-size: 20px;
          }

          th, td {
          border: 1px solid #dddddd;
          padding: 10px;
          }

          th {
          background-color: #dddddd;
          font-weight: bo
          ld;
          }
          quantity-controls button {
          background-color: #4CAF50;
          color: white;
          padding: 10px 20px;
          border: none;
          cursor: pointer;
          border-radius: 5px;
          }
          </style>
          ';

        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row["image"];
            $name = $row["product_name"];
            $price = $row["amount"];

        echo '
            <table>
            <tr>
            <br><br><br><br><br>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
               
                
            </tr>        
            <tr>
                <td>'.$row['product_name'].'</td>
                <td><img src="'.$row['image'].'" alt="'.$row['product_name'].'" width="100px" height="100px"></td>
                <td>'.$row['amount'].'</td>
              
            </tr>
            </table><br><br>

            ';
            
    }
           echo '                   
          </body>
        </html>';
               
                    
                                        $str1 = "chicken";
                            
                            if ($str1 === $proname){
                                ?>
                     <center>                        
                        <div class="quantity-controls"><br>
                             
                                Enter Product Quantity(Kgs):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="btn-minus" onclick="decrementValue('quant')">-</button>
                      
                        <input type="text" id="quant" value="0">
                        <button class="btn-plus" onclick="incrementValue('quant')">+</button>
                        </div><br><br>

                        <div>
                        Total Amount   :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id="totalAmount" value="0"><br><br><br><br>
                                            <button name="order" id="order">Order</button>

                            </div><br><br><br>
                        </center>

                            
                            <?php
                            }
                             else {

                       ?>     <center>                        
                        <div class="quantity-controls"><br>
                       
                                Enter Product Quantity  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="btn-minus" onclick="decrementValue('quant')">-</button>
                      
                        <input type="text" id="quant" value="0">
                        <button class="btn-plus" onclick="incrementValue('quant')">+</button>
                        </div><br><br>

                        <div>
                        Total Amount   :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id="totalAmount" value="0"><br><br><br><br>
                                            <button name="order" id="order">Order</button>

                            </div><br><br><br>
                </center>
                         <?php   }

                            }
                        ?>