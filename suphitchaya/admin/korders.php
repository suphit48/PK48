<?php include 'kconfig.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>จัดการคำสั่งซื้อ</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
<?php include 'kheader.php'; ?>

<div class="ml-64 p-6">
  <h2 class="text-yellow-400 text-2xl mb-4">จัดการคำสั่งซื้อ</h2>

  <!-- ฟอร์มเพิ่มออเดอร์ -->
  <form action="kadd_order.php" method="POST" class="bg-gray-800 p-4 rounded mb-6">
    <input type="text" name="customer" placeholder="ชื่อลูกค้า" required 
           class="p-2 rounded bg-gray-700 text-white w-full mb-2">
    <input type="text" name="menu" placeholder="เมนูที่สั่ง" required 
           class="p-2 rounded bg-gray-700 text-white w-full mb-2">
    <input type="number" name="total" placeholder="ราคารวม" step="0.01" required 
           class="p-2 rounded bg-gray-700 text-white w-full mb-2">
    <select name="status" class="p-2 rounded bg-gray-700 text-white w-full mb-2">
      <option value="pending">รอดำเนินการ</option>
      <option value="cooking">กำลังทำ</option>
      <option value="done">เสร็จแล้ว</option>
    </select>
    <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded">+ เพิ่มออเดอร์</button>
  </form>

  <!-- ตารางออเดอร์ -->
  <table class="w-full bg-gray-800 rounded">
    <tr class="bg-gray-700">
      <th class="p-3">ID</th>
      <th class="p-3">ลูกค้า</th>
      <th class="p-3">เมนู</th>
      <th class="p-3">รวม</th>
      <th class="p-3">สถานะ</th>
      <th class="p-3">วันที่</th>
      <th class="p-3">การจัดการ</th>
    </tr>
    <?php
      $res = $conn->query("SELECT * FROM orders ORDER BY id DESC");
      while($row = $res->fetch_assoc()):
    ?>
    <tr class="border-b border-gray-700">
      <td class="p-3"><?= $row['id']; ?></td>
      <td class="p-3"><?= htmlspecialchars($row['customer']); ?></td>
      <td class="p-3"><?= htmlspecialchars($row['menu']); ?></td>
      <td class="p-3 text-yellow-400">฿<?= $row['total']; ?></td>
      <td class="p-3">
        <?php if($row['status']=="pending") echo "🕑 รอดำเนินการ"; ?>
        <?php if($row['status']=="cooking") echo "🍳 กำลังทำ"; ?>
        <?php if($row['status']=="done") echo "✅ เสร็จแล้ว"; ?>
      </td>
      <td class="p-3"><?= $row['created_at']; ?></td>
      <td class="p-3">
        <a href="kdelete_order.php?id=<?= $row['id']; ?>" 
           onclick="return confirm('ลบออเดอร์นี้?')" 
           class="bg-red-600 px-3 py-1 rounded">ลบ</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>

