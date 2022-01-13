var fs = require('fs');

const args = process.argv;

const xAxisTitle = args[2]
const xData      = JSON.parse(args[3])
const yData      = JSON.parse(args[4])
const errorYData = JSON.parse(args[5])

var data = [{
    x: xData,
    y: yData,
    error_y: {
        type: 'data',
        array: errorYData,
        visible: true
    },
    type: 'scatter',
    marker: {
      color: 'rgb(0, 0, 0)',
    }
}]

var layout = {
    xaxis: {
        title: xAxisTitle,
    },
    yaxis: {
        title: '<b>Error + Incertidumbre</b>',
    }
};


var options = {
    fileopt : "overwrite",
    filename : "grafica-certificado",
    layout: layout
};

var plotly = require('plotly')(process.env.USERNAME, process.env.API_KEY)
plotly.plot(data, options, function (err, msg) {
	if (err) return console.log(err);

    fs.writeFile('storage/app/grafica-certificado.txt', msg.url+'.jpg', function (err) {
        if (err) throw err;
    });
});
