<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?=Config::$cssRoot ?>bootstrap.css" rel="stylesheet" />
<script src="<?=Config::$jsRoot ?>bootstrap.js"></script>
<script src="<?=Config::$jsRoot ?>jquery.js"></script>
<script src="<?=Config::$jsRoot ?>action.js"></script>
<title>Payment</title>
</head>
<body>
    <div class="content col-sm-offset-3 col-sm-6">
    <h1>Payment→<label class="label label-primary">管理你的迷你帳戶</label></h1>
    <div class="row">
    <hr>
    <div class="col-sm-offset-3 col-sm-4">
    <input class="form-control" type="text" name="count" id="id" />
    </div>
    <button class="btn btn-warning btn-md" id="changeId" >切換帳號</button>
    <div class="row">
        <br>
        <hr>
    </div>
    <div id="listContent">

    </div>
    <div class="row">
        <hr>
    </div>
    <h4 class="text-center"><div id="result">歡迎使用</div></h4>
    <div class="col-sm-offset-4 col-sm-4 row">
    <input class="form-control" type="number" name="count" id="count" min="0"/><br>
    </div>

    <div class="col-sm-offset-4 col-sm-4 text-center">
    <button class="btn btn-success btn-md" id="withdrawal" >提款</button>
    <button class="btn btn-info btn-md" id="deposit" >存款</button>
    </div>
    </div>
</body>
</html>