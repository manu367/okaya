<!DOCTYPE html>
<html>
<head>
    <title>Success Modal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Modal background */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 350px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Close button */
        .close-btn {
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 22px;
            cursor: pointer;
            color: red;
        }

        .success-text {
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {transform: scale(0.8); opacity: 0;}
            to {transform: scale(1); opacity: 1;}
        }
    </style>
</head>
<body>

<!-- Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Success ✅</h2>
        <p class="success-text">Your action was completed successfully!</p>
    </div>
</div>

<script>
    // Show modal automatically on page load
    window.onload = function() {
        document.getElementById("successModal").style.display = "block";
    };

    // Close modal
    function closeModal() {
        document.getElementById("successModal").style.display = "none";
    }
</script>

</body>
</html>
