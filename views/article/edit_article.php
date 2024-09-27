<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="../home.php">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../home.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../category/category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../author/author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Chỉnh sửa bài viết</h3>
                <form action="http://localhost:3000/index.php?controller=Article&action=update" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblma_bai_viet">Mã bài viết</span>
                        <input type="text" class="form-control" name="txt_ma_bviet" value = "<?php echo $article_suppliersRow['ma_bviet'] ?>" readonly>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lbltieu_de">Tiêu đề</span>
                        <input type="text" class="form-control" name="txt_tieude" value = "<?php echo $article_suppliersRow['tieude'] ?>"> <br>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblten_bai_hat">Tên bài hát</span>
                        <input type="text" class="form-control" name="txt_ten_bhat" value = "<?php echo $article_suppliersRow['ten_bhat'] ?>"> <br>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblthe_loai">Thể loại:</span>
                        <select class="form-select" id="the_loai" name="txt_ma_tloai" value = "<?php echo $article_suppliersRow['ten_tloai'] ?>"required>
                            <?php 
                                $sql_category = "SELECT ma_tloai, ten_tloai FROM theloai";
                                $result_category = $conn->query($sql_category);
                                while($row = $result_category->fetch_assoc()){
                                    echo '<option value="' . $row['ma_tloai'] . '">' . $row['ten_tloai'] . '</option>';
                                } 
                            ?> 
                        </select><br>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lbltom_tat">Tóm tắt</span>
                        <input type="text" class="form-control" name="txt_tomtat" value = "<?php echo $article_suppliersRow['tomtat'] ?>" required> <br>
                    </div>
                    
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lbltac_gia">Tác giả:</span>
                        <select class="form-select" id="tac_gia" name="txt_ma_tgia" value = "<?php echo $article_suppliersRow['ten_tgia'] ?>" required>
                        <?php 
                                $sql_author = "SELECT ma_tgia, ten_tgia FROM tacgia";
                                $result_author = $conn->query($sql_author);
                                while($row = $result_author->fetch_assoc()){
                                    echo '<option value="' . $row['ma_tgia'] . '">' . $row['ten_tgia'] . '</option>';
                                } 
                            ?> 
                        </select><br>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblngay_viet">Ngày viết:</span>
                        <input type="date" class="form-control" name="txt_ngayviet" value = "<?php echo $article_suppliersRow['ngayviet'] ?>" required> <br>
                    </div>

                    <div class="form-group  float-end ">
                        <button  name = "btnEdit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu </button>
                        <a href="http://localhost:3000/index.php?controller=Article&action=index" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
