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







----------------------------------------------------------------
TEMPLATE
---------
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

if (isset($_GET['InventoryDel']) && $_GET['InventoryDel'] == '1' && isset($_SESSION['InventoryDel'])) {
    echo <<<EOL
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You are about to delete the inventory. This action cannot be undone.',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    reverseButtons: false,
                    focusCancel: true,
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the delete action here
                        window.location.href = 'inventorylist.php'; // Replace with your actual delete script URL
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Handle the cancel action here
                        window.location.href = 'inventorylist.php'; // Redirect back to the inventory list page
                    }
                });
            </script>
    EOL;
    unset($_SESSION['InventoryDel']);
}

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