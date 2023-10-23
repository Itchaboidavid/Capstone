<!DOCTYPE html>
<html>

<head>
    <title>Quarterly Grade Calculator</title>
</head>

<body>
    <h1>Quarterly Grade Calculator</h1>

    <form>
        <label for="q1">1st Quarter Grade:</label>
        <input type="number" id="q1" step="0.01" oninput="calculateAverage()">

        <label for="q2">2nd Quarter Grade:</label>
        <input type="number" id="q2" step="0.01" oninput="calculateAverage()">
    </form>

    <label for="average">Average Grade:</label>
    <input type="text" id="average" readonly>

    <script>
        function calculateAverage() {
            var q1 = parseFloat(document.getElementById("q1").value);
            var q2 = parseFloat(document.getElementById("q2").value);

            if (!isNaN(q1) && !isNaN(q2)) {
                var average = (q1 + q2) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("average").value = roundedAverage;
            }
        }
    </script>
</body>

</html>