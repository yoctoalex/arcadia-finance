(function(){
    var opts = {
        angle: 0.35,
        lineWidth: 0.1,
        radiusScale: 0.89,
        pointer: {
            length: 0.6,
            strokeWidth: 0.035,
            color: '#000000'
        },
        fontSize: 40,
        limitMax: false,
        limitMin: false,
        colorStart: '#24b314',
        colorStop: '#24b314',
        strokeColor: '#EEEEEE',
        generateGradient: false,
        highDpiSupport: true,
    };

    var target = document.getElementById('gauge');
    var gauge = new Donut(target).setOptions(opts);
    gauge.maxValue = 1000;
    gauge.setMinValue(0);
    gauge.animationSpeed = 16;
    gauge.set(0);

    const updateColor = (num) => {
        var color = '#24b314';
        if (num > 300) {
            color = '#fbe4a0';
        }
        if (num > 500) {
            color = '#e65252';
        }

        const opts = {
            angle: 0.35,
            lineWidth: 0.1,
            radiusScale: 0.89,
            pointer: {
                length: 0.6,
                strokeWidth: 0.035,
                color: '#000000'
            },
            fontSize: 40,
            limitMax: false,
            limitMin: false,
            colorStart: color,
            colorStop: color,
            strokeColor: '#EEEEEE',
            generateGradient: false,
            highDpiSupport: true,
        }
        gauge.setOptions(opts);
    }

    const testConnection = async () => {
        const URL = "assets/mortgage-calc-bk.png";
        const start_time = new Date().getTime();
        let time1 = performance.now();
        const data = await fetch(URL + "?dummy=" + start_time)
            .catch((er) => {
                game_log(er.message);
            })
            .then((response) => {
                const test = response.text
        });
        let val = Math.ceil(performance.now() - time1);
        gauge.set(val);
        document.getElementById("preview-textfield").style.setProperty("--num", val);
        setTimeout(testConnection, 2000);
        updateColor(val);

    };

    const extractHostname = (url) => {
        var hostname;
        if (url.indexOf("//") > -1) {
            hostname = url.split('/')[2];
        } else {
            hostname = url.split('/')[0];
        }

        hostname = hostname.split(':')[0];
        hostname = hostname.split('?')[0];

        return hostname;
    }

    testConnection();
    const hostname = extractHostname(window.location.href);
    document.getElementById("hostname-label").innerText = `${hostname}`;
}).call(this);

