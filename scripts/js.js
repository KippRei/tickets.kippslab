// Ensures money shows to two decimal points
var price = 15;
let mailingListEmail = "";
let mailingListFName = "";
let mailingListLName = "";

$(document).ready(function() {
    $(".moneyField").change(function() {
        $(this).val(parseFloat($(this).val()).toFixed(2));
    });
});

$(document).ready(function() {
    let button = document.getElementsByClassName('eventButton');
    $(".eventImageLoc").click(function() {
        preventDefaults();
        console.log('clicked' + this);
    })
})


// For collapsible tables
$(document).ready(function() {
var openTable = document.getElementsByClassName("content-open");

for (let i = 0; i < openTable.length; i++)
{
    openTable[i].style.maxHeight = openTable[i].scrollHeight + "px";
}

var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var allOpen = document.getElementsByClassName("content");
    var content = this.nextElementSibling;
    var isOpen=0;

    if (content.style.maxHeight)
    {
        isOpen = true;
    }
    else
    {
        isOpen = false;
    }

    for (let i = 0; i < allOpen.length; i++)
    {
        if (allOpen[i].style.maxHeight)
        {
            allOpen[i].style.maxHeight = null;
        }
    }

    if (isOpen){
      content.style.maxHeight = null;
    }
    else
    {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}
});

function ShowPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

// PayPal Button Stuff
var isBuyBtnDisplayed = false;
var re = /.+@.+\..+/;
const regex = new RegExp(re);

function CheckForm() {
    let fields = document.getElementsByClassName("waiverInput");
    let emailField = document.getElementsByClassName("email");
    let chkBox = document.querySelector('#waiverCheckbox').checked;
    let filledOut = true;

    let emailCheck = true;

    for (let i = 0; i < emailField.length; i++)
    {
        if (!regex.test(emailField[i].value))
        {
            emailCheck = false;
        }
    }
    
    if (chkBox && emailCheck)
    {
        for (let i = 0; i < fields.length; i++)
        {
            if (fields[i].value <= 0)
            {
                filledOut = false;
            }
        }
    }
    else
    {
        filledOut = false;
    }

    if (filledOut && !isBuyBtnDisplayed)
    {
        isBuyBtnDisplayed = true;
        SetTotal();
        document.getElementById("paypal-button").style.display = "block";
        document.getElementById("formWarning").style.display = "none";
    }
    else if (!filledOut)
    {
        isBuyBtnDisplayed = false;
        document.getElementById("formWarning").style.display = "block";
        document.getElementById("paypal-button").style.display = "none";
    }
}

function CheckReferral() {
    // for possible future validation prior to server call
}

function GetPrice() {
    var id = document.getElementById("id").value;
    $.ajax({
        type: "POST",
        url: 'scripts/getPrice.php',
        data: {id: id},
        success: function(response)
        {
            price = response;
        },
        error: function(response)
        {
            console.log("Error: " + response);
        }
    });
}

function PopulateTicketForm() {
    var ticketQuant = document.getElementById("tickets").value;
    let ticketForm = "";

    for (let i = 1; i <= ticketQuant; i++)
    {
        ticketForm +=
               `<hr>\
                <div class="ticketInfoLbl">Ticket #${i}:</div>\
                <label for="fname${i}" class="waiverInputStyle">First Name:</label><br/>\
                <input type="text" id="fname${i}" class="fname waiverInput" name="fname${i}" oninput="CheckForm()" required>\
                <br/>\
                <label for="lname${i}" class="waiverInputStyle">Last Name:</label><br/>\
                <input type="text" id="lname${i}" class="lname waiverInput" name="lname${i}" oninput="CheckForm()" required>\
                <br/>\
                <label for="email${i}" class="waiverInputStyle">Enter Email:</label><br/>\
                <input type="text" id="email${i}" class="email waiverInput" name="email${i}" oninput="CheckForm()" required>\
                <br/>`;
         
        // AFFILIATES
        // Uncomment to allow affiliate codes
        if (i == 1)
        {
            ticketForm +=  `<label for="referral" class="waiverInputStyle">Referral Code (Optional):</label><br/>\
                            <input type="text" id="referral" class="waiverInputStyle" name="referral" oninput="CheckReferral()">\
                            <br/>
                            <div id="refValidText"></div>
                            <br/>`;
        }
        //
        
        if (i == 1 && ticketQuant > 1)
        {
            ticketForm +=  `<div class="waiverCheckboxLoc">
                            <input type="checkbox" id="sameEmailCheckbox" onclick="SameEmail(); CheckForm();">
                            <div id="sameEmailCheckboxText">
                            Check this box to use the same email
                            for all tickets.
                            </div>
                            </div>`
        }
    }

    document.getElementById("ticketForm").innerHTML = ticketForm;

    SetTotal();
}

function SameEmail() {
    let chkBox = document.querySelector('#sameEmailCheckbox').checked;
    if (chkBox)
    {
        let emailField = document.getElementsByClassName("email");
        let email = emailField[0];
        for (let i = 1; i < emailField.length; i++)
        {
            emailField[i].value = email.value;
        }
    }
    else
    {
        let emailField = document.getElementsByClassName("email");
        let email = emailField[0];
        for (let i = 1; i < emailField.length; i++)
        {
            if (emailField[i].value == email.value)
            {
                emailField[i].value = "";
            }
        }
    }
}

function SetTotal() {
    var id = document.getElementById("id").value;

    $.ajax({
        type: "POST",
        url: 'scripts/getPrice.php',
        data: {id: id},
        success: function(response)
        {
            price = response * document.getElementById("tickets").value;
            document.getElementById("paypal-button").innerHTML = "";
            PPButton();
        },
        error: function(response)
        {
            console.log("Error: " + response);
        }
    });
}

// Currently does not allow for real payments
function PPButton() 
{
    let shape = "rect";
    let size = "large";
    if (window.innerWidth < 395)
    {
        size = "medium";
    }

    if (window.innerWidth > 500)
    {
        shape = "pill";
    }

    if (price <= 0)
    {
        var node = document.createElement("button");
        node.setAttribute("id", "freePayButton");
        node.innerHTML="Free";
        document.getElementById("paypal-button").appendChild(node);
    }
    else
    {
        var node = document.createElement("button");
        node.setAttribute("id", "freePayButton");
        node.innerHTML="Pay";
        document.getElementById("paypal-button").appendChild(node);    
    }
    
    ///////////////////////////////////////////////////////////////////
    //////////////////////////// DISABLED! ////////////////////////////
    ////////////// THIS NORMALLY CAPTURES PAYPAL PAYMENT //////////////
    ////IN ORDER TO ACCEPT PAYMENTS, PAYPAL SDK SCRIPT WILL NEED TO ///
    /////////////////////BE ADDED TO SIGNUP.PHP////////////////////////
    // else
    // {
    //     paypal.Buttons({
    //         createOrder: function(data, actions) {
    //           // This function sets up the details of the transaction, including the amount and line item details.
    //           return actions.order.create({
    //             purchase_units: [{
    //               amount: {
    //                 value: price
    //               }
    //             }],
    //             application_context: {
    //                 shipping_preference: 'NO_SHIPPING'
    //             }
    //           });
    //         },
    //         // Customize button (optional)
    //         locale: 'en_US',
    //         style: {
    //         layout: 'vertical',
    //         fundingicons: 'true',
    //         },
    //         // Disallow PayPal Credit
    //         funding: {
    //             allowed: [paypal.FUNDING.CARD],
    //             disallowed: [paypal.FUNDING.CREDIT]
    //         },
    //         onApprove: function(data, actions) {
    //             document.getElementById("loadingBG").style.display="block";
    //             document.getElementById("addSkater").submit();
    //           // This function captures the funds from the transaction.
    //           //return actions.order.capture().then(function(details) {
    //             // This function shows a transaction success message to your buyer.
    //           //});
    //         }
    //       }).render('#paypal-button');
    //       //document.getElementById("paypal-button").style.display = "none";
    // }
    //////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////
}

function AddToDb() {
    var id = document.getElementById("id").value;
    var date = document.getElementById("date").innerHTML;
    var time = document.getElementById("time").innerHTML;
    var ticketQuant = document.getElementById("tickets").value;
    var fname = document.getElementsByClassName("fname");
    var lname = document.getElementsByClassName("lname");
    var email = document.getElementsByClassName("email");
    
    // AFFILIATES
    // Allow affiliate codes (uncomment and comment below to allow codes)
    var referral = document.getElementById("referral").value.replaceAll(' ', '');
    
    // No affiliate codes (comment out and uncomment above to allow codes)
    // var referral = "-";
    
    var fnameArr = [];
    var lnameArr = [];
    var emailArr =[];
    
    for (let i = 0; i < ticketQuant; i++)
    {
        fnameArr.push(fname[i].value);
        lnameArr.push(lname[i].value);
        emailArr.push(email[i].value);
    }
    mailingListFName = fnameArr[0];
    mailingListLName = lnameArr[0];
    mailingListEmail = emailArr[0];

    fnameArr = JSON.stringify(fnameArr);
    lnameArr = JSON.stringify(lnameArr);
    emailArr = JSON.stringify(emailArr);

    $.ajax({
        type: "POST",
        url: 'scripts/addToDb.php',
        data: {id: id,
               fnameArr: fnameArr,
               lnameArr: lnameArr,
               emailArr: emailArr,
               referral: referral,
               ticketQuant: ticketQuant},
        success: function(response)
        {
            MailTicket(response, id, fnameArr, lnameArr, emailArr, date, time, ticketQuant);
        },
        error: function(response)
        {
            console.log('error adding to db')
        }
    });
}

function MailTicket(ticketNums, id, fnameArr, lnameArr, emailArr, date, time, ticketQuant) {
    $.ajax({
        type: "POST",
        url: 'email/ticketEmail.php',
        data: {ticketNums: ticketNums,
               id: id,
               fnameArr: fnameArr,
               lnameArr: lnameArr,
               emailArr: emailArr,
               date: date,
               time: time,
               ticketQuant: ticketQuant},
        success: function(response)
        {
            window.location.href=`/confirm.php?id=${id}`;
        },
        error: function(response)
        {
            // TODO: send to error page
        }
    });
}

function DeleteEventPopup() {
    var popup = document.getElementById("deleteConfirmPopup");
    var popupBG = document.getElementById("popupBG");
    popup.style.visibility = "visible";
    popupBG.style.visibility = "visible";
    popupBG.style.backgroundColor = "rgba(0, 0, 0, 0.856)";
}

function ClosePopup() {
    var popup = document.getElementById("deleteConfirmPopup");
    var popupBG = document.getElementById("popupBG");
    popup.style.visibility = "hidden";
    popupBG.style.visibility = "hidden";
    popupBG.style.backgroundColor = "rgba(0, 0, 0, 0)";
}

function SoldOutPopup() {
    var popup = document.getElementById("soldOutPopup");
    var popupBG = document.getElementById("soldOutPopupBG");
    popup.style.visibility = "visible";
    popupBG.style.visibility = "visible";
    popupBG.style.backgroundColor = "rgba(0, 0, 0, 0.756)";
    popupBG.style.backdropFilter = "blur(2px)";
}

function CloseSoldOutPopup() {
    var popup = document.getElementById("soldOutPopup");
    var popupBG = document.getElementById("soldOutPopupBG");
    popup.style.visibility = "hidden";
    popupBG.style.visibility = "hidden";
    popupBG.style.backgroundColor = "rgba(0, 0, 0, 0)";
    popupBG.style.backdropFilter = "none";
}

function CloseRules() {
    document.getElementById("rules").remove();
}

function Print() {
    document.getElementById("printBtn").style.display="none";
    window.print();
    document.getElementById("printBtn").style.display="block";
}

// Opt-in mailing list
function AddToMailingList() {
    let fname = document.getElementById('mailingListFName').value;
    let lname = document.getElementById('mailingListLName').value;
    let email = document.getElementById('mailingListEmail').value;
    $.ajax({
        type: "POST",
        url: 'scripts/addToMailingList.php',
        data: {fname: fname,
               lname: lname,
               email: email},
        success: function(response)
        {
            document.getElementById('mailingListFName').disabled = true;
            document.getElementById('mailingListLName').disabled = true;
            document.getElementById('mailingListEmail').disabled = true;
            document.getElementById('mailingListBtn').disabled = true;
            document.getElementById('mailingListBtn').style.backgroundColor = "gray";
            alert ("Added to Mailing List!");
        },
        error: function(response)
        {
            // TODO: send to error page
        }
    });
}

// For manually adding entries via admin page
function AddToFullMailingList() {
    let fname = document.getElementById('fname').value;
    let lname = document.getElementById('lname').value;
    let email = document.getElementById('email').value;
    $.ajax({
        type: "POST",
        url: 'scripts/addToMasterMailingList.php',
        data: {fname: fname,
               lname: lname,
               email: email},
        success: function(response)
        {
            if (response === '1062')
            {
                alert (email + " has already been added to mailing list");
            }
            else if (response === '0')
            {
                alert ("Successfully added " + email + " to mailing list");
            }
            else
            {
                alert ("Unknown problem adding to mailing list\nError Code: " + response);
            }
        },
        error: function(response)
        {
            // TODO: send to error page
        }
    });
}

function GetMailingList() {
    window.location.href="scripts/downloadMailingList.php";
    // $.ajax({
    //     type: "GET",
    //     url: 'scripts/downloadMailingList.php',
    //     data: {},
    //     success: function(response)
    //     {
    //         console.log(response);
    //     },
    //     error: function(response)
    //     {
    //         // TODO: send to error page
    //     }
    // });
}