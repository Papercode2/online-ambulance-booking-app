<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ambulance</title>
</head>
<body>
    <h2>Add New Ambulance</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('ambulances.store') }}" method="POST">
        @csrf
        <label for="driver_name">Driver Name:</label>
        <input type="text" name="driver_name" required>
    
        <label for="driver_phone">Driver Phone:</label>
        <input type="text" name="driver_phone" required>
    
        <label for="vehicle_number">Vehicle Number:</label>
        <input type="text" name="vehicle_number" required>
    
        <label for="plate_number">Plate Number:</label>
        <input type="text" name="plate_number" required>
    
        <button type="submit">Add Ambulance</button>
    </form>
    
</body>
</html>
