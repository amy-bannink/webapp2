<?php session_start();
include('./dbcalls/read-admin.php');
include('./dbcalls/read-message.php');
// include('./dbcalls/update-message.php');




$readMessages = array_filter($result, fn($msg) => $msg['status'] === 'read');
$unreadMessages = array_filter($result, fn($msg) => $msg['status'] === 'unread');

$readIndex = isset($_GET['read_index']) ? (int) $_GET['read_index'] : 0;
$unreadIndex = isset($_GET['unread_index']) ? (int) $_GET['unread_index'] : 0;

$readMessage = array_values($readMessages)[$readIndex] ?? null;
$unreadMessage = array_values($unreadMessages)[$unreadIndex] ?? null;

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Admin</title>
</head>

<body>

    <header class="admin">
        <?php
        include('./includes/small-header.php');
        ?>
    </header>


    <main>
         <div class="admin-title">
            <a href="admin.php">
                <h2 class="admin1-header">Administration</h2>
            </a>
            <a href="admin-crud.php">
                <h2>Crud system</h2>
            </a>
        </div>



        <div class="admin-messages">


            <section class="admin-read-messages">
                <h2>Read messages</h2>
                <?php
                if (isset($_GET['message']) && $_GET['message'] === 'deleted') {
                    echo "<p style='color: red;'>Bericht succesvol verwijderd.</p>";
                }
                ?>
                <?php if ($readMessage): ?>
                    <div class="admin-received-message">
                        <p><strong>Name:</strong>
                            <?= htmlspecialchars($readMessage['first_name'] . ' ' . $readMessage['last_name']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($readMessage['email']) ?></p>
                        <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($readMessage['message'])) ?></p>
                        <p><strong>Sent at:</strong> <?= htmlspecialchars($readMessage['sent_at']) ?></p>

                        <!-- <form method="post" action="reply.php">
                            <textarea name="reply_message" class="admin-reply-message" placeholder="Write a reply..."
                                required></textarea>
                            <input type="hidden" name="contact_id" value="<?= $readMessage['contact_id'] ?>">
                            <button type="submit" class="send-reply-btn">Send reply</button>
                        </form> -->

                        <form method="post" action="/dbcalls/delete-message.php"
                            onsubmit="return confirm('Are  you sure you want to delete this message?');">
                            <input type="hidden" name="contact_id" value="<?= $readMessage['contact_id'] ?>">
                            <button type="submit" class="delete-message-btn">Delete message</button>
                        </form>
                    </div>

                    <div class="nav-buttons">
                        <?php if ($readIndex > 0): ?>
                            <a href="?read_index=<?= $readIndex - 1 ?>&unread_index=<?= $unreadIndex ?>">← Previous</a>
                        <?php endif; ?>
                        <?php if ($readIndex < count($readMessages) - 1): ?>
                            <a href="?read_index=<?= $readIndex + 1 ?>&unread_index=<?= $unreadIndex ?>">Next →</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>No read messages.</p>
                <?php endif; ?>
            </section>

            <section class="admin-unread-messages">
                <h2>Unread messages</h2>
                <?php if ($unreadMessage): ?>
                    <div class="admin-received-message">
                        <p><strong>Name:</strong>
                            <?= htmlspecialchars($unreadMessage['first_name'] . ' ' . $unreadMessage['last_name']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($unreadMessage['email']) ?></p>
                        <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($unreadMessage['message'])) ?></p>
                        <p><strong>Sent at:</strong> <?= htmlspecialchars($unreadMessage['sent_at']) ?></p>
                        <form method="post" action="./dbcalls/update-message.php"
                            onsubmit="return confirm('Mark this message as read?');">
                            <input type="hidden" name="contact_id" value="<?= $unreadMessage['contact_id'] ?>">
                            <button type="submit" class="mark-read-btn">Mark as read</button>
                        </form>

                        <!-- <form method="post" action="reply.php">
                            <textarea name="reply_message" class="admin-reply-message" placeholder="Write a reply..."
                                required></textarea>
                            <input type="hidden" name="contact_id" value="<?= $unreadMessage['contact_id'] ?>">
                            <button type="submit" class="send-reply-btn">Send reply</button>
                        </form> -->

                        <form method="post" action="/dbcalls/delete-message.php"
                            onsubmit="return confirm('Are  you sure you want to delete this message?');">
                            <input type="hidden" name="contact_id" value="<?= $unreadMessage['contact_id'] ?>">
                            <button type="submit" class="delete-message-btn">Delete message</button>
                        </form>
                    </div>

                    <div class="nav-buttons">
                        <?php if ($unreadIndex > 0): ?>
                            <a href="?read_index=<?= $readIndex ?>&unread_index=<?= $unreadIndex - 1 ?>">← Previous</a>
                        <?php endif; ?>
                        <?php if ($unreadIndex < count($unreadMessages) - 1): ?>
                            <a href="?read_index=<?= $readIndex ?>&unread_index=<?= $unreadIndex + 1 ?>">Next →</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>No unread messages.</p>
                <?php endif; ?>
            </section>

        </div>






    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>