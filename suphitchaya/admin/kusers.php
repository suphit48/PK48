<?php include 'kconfig.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการผู้ใช้</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
<?php include 'kheader.php'; ?>

<div class="ml-64 p-6">
  <h2 class="text-yellow-400 text-2xl mb-4">จัดการผู้ใช้</h2>

  <!-- ฟอร์มเพิ่มผู้ใช้ -->
  <form action="kadd_user.php" method="POST" class="bg-gray-800 p-4 rounded mb-6">
    <input type="text" name="name" placeholder="ชื่อผู้ใช้" required 
           class="p-2 rounded bg-gray-700 text-white w-full mb-2">
    <input type="email" name="email" placeholder="อีเมล" required 
           class="p-2 rounded bg-gray-700 text-white w-full mb-2">
    <input type="text" name="phone" placeholder="เบอร์โทร" 
           class="p-2 rounded bg-gray-700 text-white w-full mb-2">
    <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded">+ เพิ่มผู้ใช้</button>
  </form>

  <!-- ตารางผู้ใช้ -->
  <table class="w-full bg-gray-800 rounded">
    <tr class="bg-gray-700">
      <th class="p-3">ID</th>
      <th class="p-3">ชื่อ</th>
      <th class="p-3">อีเมล</th>
      <th class="p-3">เบอร์โทร</th>
      <th class="p-3">สถานะ</th>
      <th class="p-3">การจัดการ</th>
    </tr>
    <?php
      $res = $conn->query("SELECT * FROM users ORDER BY id DESC");
      while($row = $res->fetch_assoc()):
    ?>
    <tr class="border-b border-gray-700">
      <td class="p-3"><?= $row['id']; ?></td>
      <td class="p-3"><?= htmlspecialchars($row['name']); ?></td>
      <td class="p-3"><?= htmlspecialchars($row['email']); ?></td>
      <td class="p-3"><?= htmlspecialchars($row['phone']); ?></td>
      <td class="p-3"><?= $row['status']; ?></td>
      <td class="p-3">
        <a href="kdelete_user.php?id=<?= $row['id']; ?>" 
           onclick="return confirm('ลบผู้ใช้นี้?')" 
           class="bg-red-600 px-3 py-1 rounded">ลบ</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>

