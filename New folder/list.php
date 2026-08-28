<td>
    <a href="edit.php?edit=<?= $row['id']; ?>" class="btn btn-warning btn-sm me-1">Edit</a>
    <a href="list.php?delete=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
</td>