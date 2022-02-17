const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
    e.preventDefault();
    let handler = PaystackPop.setup({
        key: <?php echo $_SESSION['payment'][3]; ?>, // Replace with your public key
        email: document.getElementById("email-address").value,
        amount: document.getElementById("amount").value * 100,
        ref: <?php echo $_SESSION['payment'][0]; ?>, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        // label: "Optional string that replaces customer email"
        onClose: function(){
            alert('Window closed.');
        },
        callback: function(response){
            //let message = 'Payment complete! Reference: ' + response.reference;
            //alert(message);
            window.location = "verify_transaction.php?reference="+ response.reference;
        }
    });
    handler.openIframe();
}
