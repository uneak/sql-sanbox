const url = "https://localhost/paiement_pattern_exo2.php";

let modeDePaiement ='';
form_choice_payment.onsubmit = (e) =>{
//    output.textContent = `Le mode de paiement choisis est ${payment_mode.value}`;
   modeDePaiement = payment_mode.value;
//    alert(modeDePaiement);
//    console.log("modeDePaiemant => ",modeDePaiement);
   const data = new URLSearchParams(new FormData(form_choice_payment));
   fetchPaymentMode(url,data);

   e.preventDefault();
}

async function fetchPaymentMode(url,data) {
    const request = await fetch(url,{
        method:"post",
        body: data,
    })

    if (!request.ok) {
        alert('un problème est survenue !!!!')
    } else {
        
        switch (modeDePaiement) {
            case 'CB':
                window.location.assign(
                    "https://localhost/agnes/cb.php",
                );
                break;
            case 'PAYPAL':
                window.location.assign(
                    "https://localhost/agnes/paypal.php",
                );
                break;
            case 'VIREMENT':
                window.location.assign(
                    "https://localhost/agnes/virement.php",
                );
                break;
            default:
                break;
        }
        
        // alert('c\'est OK');
        let response = await request.text();
        console.log("response =>",response);
        //Remplacer la page 
        //* Arrive pas alors 
        //*je fais une nouvelle page PHP du coup
        // console.log("document => ", document);
        
          
    }   
}

