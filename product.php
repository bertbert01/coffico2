<?php include "db_connection.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple HTML Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 0;
            text-align: center;
        } 
        footer a {
         
          text-decoration: none;
          margin: 0 10px;
        }
        .espresso-products {
          text-align: center;
          margin-left: 2px;
          margin-top: 20px;
          margin-bottom: 90px; /* Add extra bottom margin */
        }
        .espresso-products h4 {
          margin-bottom: 30px;
        }
        .espresso-products .product {
          display: inline-block;
          margin: 4px 2px 2px 2px; /* Add margin with 5px */
        }
        .espresso-products .product-container {
          background-color: white; /* Add white background */
          padding: 15px; /* Add padding */
          border-radius: 5px; /* Add border radius */
          cursor: pointer; /* Change cursor to pointer */
        }
        .espresso-products .product img {
          height: 200px; /* Equal height for all images */
          width: 150px; /* Equal width for all images */
          object-fit: cover; /* Ensure images maintain aspect ratio and cover the container */
        }
        .product-container {
          background-color: white;
          padding: 15px;
          border-radius: 10px;
          text-align: left; /* Align text to the left */
        }
        .product-container img {
          border-radius: 10px;
        }
        .product-container p {
          margin: 5px 0; /* Adjust the margin to reduce space */
        }
        .foot {
          background-color: rgba(255, 255, 255, 0.6);
          border: 2px solid black;
          border-radius: 100px;
          margin-bottom: 15px;
        }
        .modal-body img {
          height: 90px;
          width: 90px;
          border-radius: 10px;
        }
        .modal-body button {
          background-color: #E7DCC8;
          border-radius: 5px;
          margin-left: 70%;
        }
        .price {
          margin-top: -15px;
        }
        
.oswald-font {
  background-color: white;
  font-family: "Oswald", sans-serif;
  font-optical-sizing: auto;
  font-weight: 700;
  font-style: normal;
}
  .ratings {
    margin-bottom: -15px;
  }
  .custom-swal-popup {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.custom-swal-title {
    font-size: 24px;
    color: #333;
}

.custom-swal-content {
    display: flex; 
    margin: 0;
}

.custom-swal-image {
    width: 80px;
    height: 80px;
    border-radius: 5px;
    margin-right: 10px;
}

.custom-swal-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.custom-swal-price {
    font-size: 16px;
    color: #666;
    text-align: left;
}
    </style>
</head>
<body style="background-color: #816246;">
<div class="espresso-products">
    <h4 class="oswald-font">PRODUCTS</h4>
    <?php
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product" data-toggle="modal" data-target="#productModal<?php echo $row['id']; ?>">
                <div class="product-container">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="150" height="200">
                    <p class="oswald-font"><?php echo $row['name']; ?></p>
                    <p>₱<?php echo $row['price']; ?></p>
                    <div class="ratings">
                        <span style="font-size: 20px; color: gold;">&#9733;</span> <span style="font-size: 16px; margin-left: -3px;">4.8/5 | 26 Sold</span>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="productModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel<?php echo $row['id']; ?>"><?php echo $row['name']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="150" height="200">
                            <p class="oswald-font"><?php echo $row['name']; ?></p>
                            <p class="price">₱<?php echo $row['price']; ?></p>
                            <p class="des">
                                <?php echo $row['description']; ?>
                            </p>
                            <button onclick="addToCart('<?php echo $row['name']; ?>', <?php echo $row['price']; ?>, '<?php echo $row['image']; ?>')">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No products found";
    }
    ?>
</div>


    

<footer style="margin-top: auto; display: flex; justify-content: space-evenly;">
        <a href="index.html" style="margin-left: 10px;"><img src="images/home.png" alt="Home" style="height: 60px;" class="foot"></a>
        <a href="product.php"><img src="images/products.png" alt="Products" style="height: 60px;" class="foot"></a>
        <a href="cart.html"><img src="images/cart.png" alt="Cart" style="height: 60px; width: auto;" class="foot"></a>
        <a href="contact.html" style="margin-right: 10px;"><img src="images/contacts.png" alt="Contacts" style="height: 60px;" class="foot"></a>
    </footer>

<script>
    function addToCart(name, price, imageUrl) {
        const item = {
            name: name,
            price: price,
            imageUrl: imageUrl
        };
        let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
        cartItems.push(item);
        localStorage.setItem('cart', JSON.stringify(cartItems));

        Swal.fire({
            icon: 'success',
            title: 'Coffee added to cart!',
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title'
            },
            html: `<div class="custom-swal-content">
                        <img src="${imageUrl}" class="custom-swal-image">
                        <div>
                            <p class="custom-swal-name">${name}</p>
                            <p class="custom-swal-price">₱${price}</p>
                        </div>
                    </div>`
        });
    }
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
