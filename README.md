# Fayeed_System


header.php
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.20/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
home.php
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.19/sweetalert2.min.js"></script>
head.php
<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.19/sweetalert2.min.js"></script>



Add
-----
echo $_SESSION['loggedin_success'] = true;
header("Location: profile.php?log_success=1");
----
Update
-----
echo $_SESSION['update_success'] = true;
header("Location: profile.php?update_success=1");
----
branch delete
-----
echo $_SESSION['delete_branc'] = true;
header("Location: branches.php?delete_branc=1");
----
branch add
-----
echo $_SESSION['addbranch'] = true;
header("Location: branches.php?addbranch=2");
----
branch update
-----
echo $_SESSION['updatedbranch'] = true;
header("Location: branches.php?updatedbranch=1");
----
user delete
----
echo $_SESSION['delete_user'] = true;
header("Location: noroles.php?delete_user=1");
----
user add
----
echo $_SESSION['add_user'] = true;
header("Location: noroles.php?add_user=2");
----
inventory del
---
echo $_SESSION['InventoryDel'] = true;
header("Location: noroles.php?InventoryDel=1");
---
invetory add
----
echo $_SESSION['InventoryAdd'] = true;
header("Location: inventorylist.php?InventoryAdd=1");
-------
invetory update
----
echo $_SESSION['InventoryUpdate'] = true;
header("Location: inventorylist.php?InventoryUpdate=1");
----
deatail branch add
---
echo $_SESSION['appointuser'] = true;
header("Location: detail-branch.php?branch=" . urlencode($branch['branchID']) . "&appointuser=1");

echo $_SESSION['changuser'] = true;
header("Location: detail-branch.php?branch=" . urlencode($branch['branchID']) . "&changuser=1");
----
disrole user
-----
if (isset($_GET['disrole'])) {
    $disroleId = $_GET['disrole'];
    // Perform the deletion here using the $disroleId
    $derole = mysqli_query($con,"DELETE FROM branch_staff WHERE staffID = $disroleId ;");

    // Assume deletion was successful for the sake of this example
    // Replace this with actual success check based on your database operation
    $deletionSuccessful = true;


}







----------------------------------------------------------------
TEMPLATE
---------
logout button,header.php:
function showLogoutConfirmation() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this. Are you sure you want to logout?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms, redirect to the logout page
            window.location.href = '../logout-user.php'; // Replace with the actual URL of your logout page
        }
    });
}
toast success add user, noroles.php :
if (isset($_GET['add_user']) && $_GET['add_user'] == '2' && isset($_SESSION['add_user'])) {
    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Deleted Successfully!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 5000
            }).then(() => {
                window.location.href = 'noroles.php';
            });
        </script>
    EOL;
    unset($_SESSION['add_user']);
}
toast success,disrole a user, noroles.php
if ($deletionSuccessful) {
    $_SESSION['disrole'] = true;

    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'User successfully Disroled!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 5000
            }).then(() => {
                // Redirect back to the appropriate page based on the 'page' parameter
                const urlParams = new URLSearchParams(window.location.search);
                const page = urlParams.get('page');
                window.location.href = page;
            });
        </script>
    EOL;
    unset($_SESSION['disrole']);
}



Adds comma separator for prices
echo "₱ " . number_format($income['Total'], 2, '.', ',');



delete confirmation, stay toast delete success just add this inside body
----
<a href="#" onclick="showInventoryDeleteConfirmation(<?php echo $inventorylist['inventoryId']; ?>)">
    <i class="fi fi-rr-trash btn btn-danger"></i>
</a>
<script>
    function showInventoryDeleteConfirmation(inventoryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this. Are you sure you want to delete this inventory?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, redirect to the delete page
                window.location.href = `inventorylist.php?delnventory=${inventoryId}`;
            }
        });
    }
</script>
