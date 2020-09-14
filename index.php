<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web-Programming</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
</head>
<body>
<script src="js/jquery-3.4.1.js"></script>
<script>
    const checkArea = function () {
        let yStr = $("#y-value-select").val().replace(",", ".");
        let x = $("#x-value-select").val().replace(",", ".");
        let y = Number(yStr);
        let r = Number($("#r-value-select").val());

        return (x >= -r && x <= 0 && y >= -r && y <= 0) || (y <= (x / 2 + r / 2) && y >= 0 && x <= 0) || ((x * x + y * y) <= r * r / 4 && x >= 0 && y >= 0);
    };

    const onInpChange = function () {
        let elemY = $("#y-value-select");

        let value = Number(elemY.val().replace(",", "."));
        return !(value <= -5 || value >= 5 || isNaN(value) || /[\s]+/.test(elemY.val()) || elemY.val() === "");
    }

    const submit = function (e) {
        e.preventDefault();
        if (!onInpChange()) {
            document.querySelector('#error-log').textContent = "Значение Y должно быть в диапазоне (-5;5)";
            return;
        }else{
            document.querySelector('#error-log').textContent = "";
        }

        const formData = new FormData(document.querySelector('#coordinates-form'));

        fetch('php/check.php', {
            method: 'POST',
            body: formData,
        })
            .then(ans => ans.text())
            .then(table => document.querySelector('#table').innerHTML = table);
    };

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#send-button').addEventListener('click', submit);
    });

    const clear = function (e) {
        e.preventDefault();

        fetch('php/clear.php', {
            method: "POST",
        })
            .then(ans => ans.text())
            .then(table => document.querySelector('#table').innerHTML = table);
    };
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#clear-button').addEventListener('click', clear);
    });


</script>
<div class="wrapper">
    <header class="header">
        <span>Variant 2805, Aleksandr Gurin, P3232</span>
    </header>
    <div class="content">
        <div class="svg-coordinates">
            <svg width="300" height="300" class="svg-graph" xmlns="http://www.w3.org/2000/svg">

                <!--            Линии оси-->

                <line class="axis" x1="0" x2="300" y1="150" y2="150" stroke="black"></line>
                <line class="axis" x1="150" x2="150" y1="0" y2="300" stroke="black"></line>
                <polygon points="150,0 144,15 156,15" stroke="black"></polygon>
                <polygon points="300,150 285,156 285,144" stroke="black"></polygon>

                <line class="coor-line" x1="200" x2="200" y1="155" y2="145" stroke="black"></line>
                <line class="coor-line" x1="250" x2="250" y1="155" y2="145" stroke="black"></line>

                <line class="coor-line" x1="50" x2="50" y1="155" y2="145" stroke="black"></line>
                <line class="coor-line" x1="100" x2="100" y1="155" y2="145" stroke="black"></line>

                <line class="coor-line" x1="145" x2="155" y1="100" y2="100" stroke="black"></line>
                <line class="coor-line" x1="145" x2="155" y1="50" y2="50" stroke="black"></line>

                <line class="coor-line" x1="145" x2="155" y1="200" y2="200" stroke="black"></line>
                <line class="coor-line" x1="145" x2="155" y1="250" y2="250" stroke="black"></line>

                <text class="coor-text" x="195" y="140">R/2</text>
                <text class="coor-text" x="248" y="140">R</text>

                <text class="coor-text" x="40" y="140">-R</text>
                <text class="coor-text" x="90" y="140">-R/2</text>

                <text class="coor-text" x="160" y="105">R/2</text>
                <text class="coor-text" x="160" y="55">R</text>

                <text class="coor-text" x="160" y="205">-R/2</text>
                <text class="coor-text" x="160" y="255">-R</text>

                <!-- first figure-->
                <polygon class="svg-figure triangle-figure" points="50,150 150,150, 150,100"
                         fill="#F38524" fill-opacity="0.3" stroke="#C56C1A"></polygon>

                <!-- second figure circle-->
                <path class="svg-figure circle-figure" d="M 200 150 A 50 50, 90, 0, 0, 150 100 L 150 150 Z"
                      fill="#FEF102" fill-opacity="0.3" stroke="#CEC101"></path>

                <!-- third figure-->
                <polygon class="svg-figure rectangle-figure" points="50,150 150,150 150,250 50,250"
                         fill="#22449E" fill-opacity="0.3" stroke="#182E82"></polygon>

                <circle r="0" cx="150" cy="150" id="target-dot"></circle>

            </svg>
        </div>

        <form class="coordinates-form" oninput="onInpChange()" id="coordinates-form">
            <div class="data-inputs">
                <div class="group">
                    <input type="text" id="y-value-select" name="y_value" required>
                    <span class="bar"></span>
                    <label>Y Value</label>
                </div>

                <div class="select-r">
                    <label for="r-value-select" class="form-label" style="margin: auto 1% auto 0;">
                        <strong>R: </strong>
                    </label>
                    <select id="r-value-select" name="r_value">
                        <option value="1">1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="range-input">
                    <label for="x-value-select">X Value: </label>
                    <span id="demo"></span>
                    <input id="x-value-select" name="x_value" type="range" min="-2" max="2" step="0.5" value="0">
                </div>

                <div class="form-buttons">
                    <button id="send-button" type="submit">Send</button>
                    <button id="clear-button" type="button">Clear</button>
                </div>

                <span id="error-log" style="color: red"> </span>
            </div>


        </form>

        <div id="table">
            <?php
            include "php/table.php";
            ?>
        </div>
    </div>
</div>
<script>


    $(document).ready(function(){
        $('input, select').each(function (i, elem) {
            elem.value = localStorage.getItem(elem.id);
        })
        output.innerHTML = slider.value;
    });

    $(window).on('beforeunload', function() {
        $('input, select').each(function (i, elem) {
            localStorage.setItem(elem.id,elem.value);
        })
    });

    const slider = document.getElementById("x-value-select");
    const output = document.getElementById("demo");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function () {
        output.innerHTML = this.value;
    }
</script>
</body>
</html>