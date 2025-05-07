<!DOCTYPE html>
<html>
<head>
    <title>Adhiyamaan College </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: url('https://images.pexels.com/photos/29229903/pexels-photo-29229903/free-photo-of-graduates-celebrating-with-caps-in-the-air.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: #fff;
        padding: 40px;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #ffffff;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
    }

    select {
        display: inline-block;
        margin: 10px;
        padding: 10px;
        width: 220px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: rgba(255, 255, 255, 0.9);
        color: #333;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: border 0.3s ease-in-out;
    }

    select:focus {
        border-color: #3498db;
        outline: none;
    }

    #students {
        margin-top: 40px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .student-card {
        background-color: rgba(255, 255, 255, 0.95);
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 15px;
        width: 200px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        transition: transform 0.3s;
    }

    .student-card:hover {
        transform: scale(1.03);
    }

    .student-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 2px solid #3498db;
    }

    .student-card span {
        display: block;
        font-weight: 600;
        color: #2c3e50;
    }
</style>

</head>
<body>

<h2>ADHIYAMAAN COLLEGE OF ENGINEERING </h2>

<div style="text-align: center;">
    <select id="department">
        <option value="">Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>

    <select id="course">
        <option value="">Select Course</option>
    </select>

    <select id="location">
        <option value="">Select Location</option>
    </select>
</div>

<div id="students"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#department').change(function() {
        let id = $(this).val();
        $('#course').html('<option>Loading...</option>');
        $('#location').html('<option>Select Location</option>');
        $('#students').empty();

        $.get('/get-courses/' + id, function(data) {
            $('#course').html('<option>Select Course</option>');
            $.each(data, function(i, item) {
                $('#course').append('<option value="' + item.id + '">' + item.name + '</option>');
            });
        });
    });

    $('#course').change(function() {
        let id = $(this).val();
        $('#location').html('<option>Loading...</option>');
        $('#students').empty();

        $.get('/get-locations/' + id, function(data) {
            $('#location').html('<option>Select Location</option>');
            $.each(data, function(i, item) {
                $('#location').append('<option value="' + item.id + '">' + item.name + '</option>');
            });
        });
    });

    $('#location').change(function() {
        let id = $(this).val();
        $('#students').html('<p style="text-align:center;">Loading students...</p>');

        $.get('/get-students/' + id, function(data) {
            $('#students').empty();
            if (data.length === 0) {
                $('#students').html('<p style="text-align:center;">No students found.</p>');
            } else {
                $.each(data, function(i, student) {
                    $('#students').append(
                        `<div class="student-card">
                            <img src="${student.image_path}" alt="${student.name}" />
                            <span>${student.name}</span>
                        </div>`
                    );
                });
            }
        });
    });
</script>

</body>
</html>
