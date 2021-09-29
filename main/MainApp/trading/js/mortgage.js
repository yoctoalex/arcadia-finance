// Close the dropdown if the user clicks outside of it
let currentTerm = 0;
let currentUnits = "$";

const terms = [
    {
        message: "Fixed 30 Years",
        term: 360
    },
    {
        message: "Fixed 20 Years",
        term: 240
    },
    {
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
    const href = "/mortgage/api/index.php";
    fetchWithTimeout(href, () => {
            $("#mk-waiting").addClass("mk-hidden");
            $("#mk-coming-soon").removeClass("mk-hidden");
            $("#mk-calc").addClass("mk-hidden");
        },
        {timeout: 5000}).then(res => {
            $("#mk-waiting").addClass("mk-hidden");

            if (res.status === 200) {
                $("#mk-coming-soon").addClass("mk-hidden");
                $("#mk-calc").removeClass("mk-hidden");
            }
            else {
                $("#mk-coming-soon").removeClass("mk-hidden");
                $("#mk-calc").addClass("mk-hidden");
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
    console.log(currentUnits);

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
        if (res.status === 200) {
            res.json().then(obj => {
                const monthlyTotal = obj.monthlyTotal;

                $("#loan-amount-value").text("$ " + ((Math.ceil(monthlyTotal * 100)/100).toString()));
                $("#mk-loan-value").removeClass("mk-hidden");
                $("#mk-loan-inscription").removeClass("mk-hidden");
            })
        }
    })
}

checkMortgageApi();
setInterval(() => {
    checkMortgageApi();
}, 3000);