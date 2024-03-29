let values = [];
const avgWindow = 20;

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
        limitMax: true,
        limitMin: true,
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

    const getColor = (num) => {
        var color = '#24b314';
        if (num > 300) {
            color = '#fbe4a0';
        }
        if (num > 500) {
            color = '#e65252';
        }

        return color;
    }

    const updateColor = (num) => {
        var color = getColor(num);

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
            limitMax: true,
            limitMin: true,
            colorStart: color,
            colorStop: color,
            strokeColor: '#EEEEEE',
            generateGradient: false,
            highDpiSupport: true,
        }
        gauge.setOptions(opts);
    }
    const getData = (ajaxurl) => {
        return $.ajax({
            url: ajaxurl,
            type: 'GET',
        });
    };

    const testConnection = async () => {
        const URL = "assets/image1.jpg";
        const start_time = new Date().getTime();
        let time1 = performance.now();
        let val = 0;

        try {
            const res = await getData(URL + "?dummy=" + start_time)
            val = Math.ceil(performance.now() - time1);
        } catch(err) {
            console.log(err);
        }

        values.push(val);
        if (values.length > avgWindow) {
            values = values.slice(values.length - avgWindow, values.length);
        }
        const current = Math.ceil(values.reduce((r, v) => r + v, 0) / values.length);

        gauge.set(current);
        document.getElementById("preview-textfield").style.setProperty("--num", current);
        updateColor(current);

        if (values.length > 0) {
            const arr = values.length < avgWindow
                ? new Array(avgWindow - values.length).fill(-1).concat(values)
                : values;

            $('#graph').simpleChart({
                title: {
                    text: '',
                    align: 'center'
                },
                type: 'column',
                layout: {
                    width: '100%',
                    height: '100%'
                },
                item: {
                    label: arr.map(x => ""),
                    value: arr,
                    outputValue: arr.map(x => x === -1 ? " " : `${x} ms`),
                    color: arr.map(x => x === -1 ? "transparent" : getColor(x)),
                    prefix: '',
                    suffix: '',
                    render: {
                        margin: 0.2,
                        size: 'relative'
                    }
                }
            });
        }

        setTimeout(testConnection, 2000);
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

