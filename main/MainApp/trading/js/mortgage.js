// Close the dropdown if the user clicks outside of it
let currentTerm = 0;
let currentUnits = "$";
let currentPage = "#mk-calc";

const terms = [
    {
        resMessage: "30-year fixed",
        message: "Fixed 30 Years",
        term: 360
    },
    {
        resMessage: "20-year fixed",
        message: "Fixed 20 Years",
        term: 240
    },
    {
        resMessage: "15-year fixed",
        message: "Fixed 15 Years",
        term: 180
    }
]

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
async function fetchWithTimeout(resource, onTimeout, options = {}) {
    const { timeout = 8000 } = options;

    const controller = new AbortController();
    const id = setTimeout(() => {
        controller.abort();
        onTimeout && onTimeout();
    }, timeout);
    const response = await fetch(resource, {
        ...options,
        signal: controller.signal
    });
    clearTimeout(id);
    return response;
}


function checkMortgageApi() {
    console.log(currentPage);

    const href = "/mortgage/api/index.php";
    fetchWithTimeout(href, () => {
            $("#mk-waiting").addClass("mk-hidden");
            $("#mk-coming-soon").removeClass("mk-hidden");
            $(currentPage).addClass("mk-hidden");
        },
        {timeout: 5000}).then(res => {
            $("#mk-waiting").addClass("mk-hidden");

            if (res.status === 200) {
                $("#mk-coming-soon").addClass("mk-hidden");
                $(currentPage).removeClass("mk-hidden");
            }
            else {
                $("#mk-coming-soon").removeClass("mk-hidden");
                $("#mk-calc").addClass("mk-hidden");
                $("#mk-res").addClass("mk-hidden");
            }
        })
}

function showOptions(e) {
    document.getElementById("mk-options").classList.toggle("show");
    e.stopImmediatePropagation();
}

function selectUnits(e, units) {
    currentUnits = units;
    switch (units) {
        case "%": {
            $("#units-usd").removeClass("mk-selected-units");
            $("#units-percent").addClass("mk-selected-units");
            break;
        }
        case "$": {
            $("#units-usd").addClass("mk-selected-units");
            $("#units-percent").removeClass("mk-selected-units");
            break;
        }
    }
}

function selectItem(item) {
    currentTerm = item;
    $("#selected-item").html(terms[item].message);
}

function fetchPayment() {
    currentPage = "#mk-res";

    $('#mk-res').addClass("mk-hidden");
    $('#mk-calc').addClass("mk-hidden");
    $('#mk-waiting').removeClass("mk-hidden");

    const price = parseFloat($('#mk-input-price').val());
    const down = parseFloat($('#mk-input-down').val());
    const term = terms[currentTerm].term;
    const zip = parseFloat($('#mk-input-zip').val());

    let downValue = down;
    if (currentUnits.trim() === "%") {
        downValue = parseFloat(down) / 100 * price;
    }

    const href = `/mortgage/api/calculate.php?price=${price}&down=${downValue}&term=${term}&zip=${zip}`
    fetch(href).then(res => {
        $('#mk-waiting').addClass("mk-hidden");
        $('#mk-res').removeClass("mk-hidden");

        if (res.status === 200) {

            res.json().then(obj => {
                console.log(obj);

                const loan = ((Math.ceil(obj.loan * 100)/100))
                    .toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                const interest = ((Math.ceil(obj.monthlyPrincipal * 100)/100))
                    .toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                const taxes = ((Math.ceil(obj.propertyTaxes * 100)/100))
                    .toLocaleString('en-US', { style: 'currency', currency: 'USD' })
                const homeownersInsurance = ((Math.ceil(obj.homeownersInsurance * 100)/100))
                    .toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                const monthlyTotal = ((Math.ceil(obj.monthlyTotal * 100)/100))
                    .toLocaleString('en-US', { style: 'currency', currency: 'USD' });

                $("#res-plan-duration").text(terms[currentTerm].resMessage);
                $("#res-loan-size").text(loan);
                $("#res-monthly-payment").text(monthlyTotal);
                $("#res-monthly-and-interest").text(interest);
                $("#res-property-taxes").text(taxes);
                $("#res-insurance").text(homeownersInsurance);
                $("#res-table-total").text(monthlyTotal);
            })
        }
    })
}

function recalculate(e) {
    currentPage = "#mk-calc";
    $('#mk-res').addClass("mk-hidden");
    $('#mk-calc').removeClass("mk-hidden");
    e.stopImmediatePropagation();
}

checkMortgageApi();
setInterval(() => {
    checkMortgageApi();
}, 3000);