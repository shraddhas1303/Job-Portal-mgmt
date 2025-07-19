<?php
$job_id = $_POST['job_id'];
?>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .form-container {
        background: #ffffff;
        border-radius: 10px;
        padding: 30px;
        max-width: 500px;
        margin: 30px auto;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .form-container h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #555;
    }

    .submit-btn {
        background-color: #28a745;
        color: white;
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .submit-btn:hover {
        background-color: #218838;
    }
</style>

<div class="form-container">
    <h3>Apply for this Job</h3>
    <form id="applicationForm" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" name="full_name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="resume">Upload Resume (PDF Only)</label>
            <input type="file" name="resume" id="resume" accept="application/pdf" required>
        </div>

        <button type="submit" class="submit-btn">Submit Application</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).on('submit', '#applicationForm', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'applications/submit-application.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    text: 'Thank you for applying.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '../job-portal-full';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message
                });
            }
        }
    });
});
</script>
