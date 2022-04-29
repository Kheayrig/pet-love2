<?php
    require_once "config/Ad.php";
    require_once "config/Favs.php";
    $breed1 = ['Волнистые попугаи','Совы','Канарейки'];
    $breed3 = ['Маленькие','Бойцовские','Большие'];
    $breed2 = ['Сфинксы','Пушистые','Гладкошёрстные'];
    $br1 = $breed1[0];
    $br2 = $breed1[1];
    $br3 = $breed1[2];
    $id_user = 1;
    $ad = Ad::getAd();
    if(isset($_POST['add'])){
        Favs::addToFavs($_POST['add'], $id_user, "pethold");
    } elseif (isset($_POST['delete'])) {
        Favs::deleteFromFavs($_POST['delete'], $id_user, "pethold");
    }
    if(isset($_POST['submit'])) {
        $type = $_POST['species'];
        $subtype = $_POST['breed'];
        $c = $_POST['city'];
        if($type !== "Все" || $subtype !== "Все" || $c !== "Все") {
            $ad = Ad::sortBy($type,$subtype,$c);
        }
        else $ad = Ad::getAd();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ardent Crew Pet Love Main Page 19.04.22</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,700&amp;display=swap">
    <link rel="stylesheet" href="assets/css/pethold.css">
    <script src="script.js"></script>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
</head>

<body class="app" style="font-family: 'Libre Franklin', sans-serif;background-image: url('&quot;assets/img/vector_bg-main.svg&quot;');background-repeat: no-repeat;background-position: 100% top;background-size: 65vw;">
    <nav class="navbar navbar-light navbar-expand-md" style="height: 85px;border-bottom: 1px solid #EDE5DE;">
        <div class="container-fluid">
            <div class="banner">
                <a href="./index.html" class="banner-link">
                    <svg width="151" height="42" viewBox="0 0 151 42" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect width="151" height="42" fill="url(#pattern0)"/><defs><pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1"><use xlink:href="#image0_2_85" transform="translate(0 -0.00591674) scale(0.00299401 0.0107642)"/></pattern><image id="image0_2_85" width="334" height="94" xlink:href="data:image/png;base64,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"/></defs></svg>
                </a>
              </div>
            <div class="collapse navbar-collapse d-xl-flex d-xxl-flex justify-content-xl-center align-items-xxl-end" id="navcol-1">
                <div class="select-div" onchange="">
                    <select class="city-select">
                        <option selected value="1">Ярославль</option>
                        <option value="2">Москва</option>
                        <option value="3">Вологда</option>
                      </select>
                </div>
                <ul class="navbar-nav text-start d-xxl-flex ms-auto align-items-xxl-center">
                    <li class="nav-item"><a class="nav-link active fw-normal" href="#" style="color: #3D2127;transform: perspective(0px);padding-right: 0px;margin-right: 72px;margin-top: 10p;">Раздел<br>для ситтеров</a></li>
                    <li class="nav-item fs-5 fw-normal d-lg-flex d-xl-flex align-items-lg-center align-items-xl-center" style="color: #3D2127;transform: perspective(0px);padding-right: 0px;margin-right: 72px;margin-top: 10p;"><a class="nav-link fs-6 fw-normal" href="#" style="color: #3D2127;transform: perspective(0px);padding: 9px 72px 8px 7px;padding-right: 0px;margin-top: 10p;">Создать заказ</a></li>
                    <li class="nav-item d-lg-flex d-xl-flex align-items-lg-center align-items-xl-center"><a class="nav-link" href="#" style="color: #3D2127;margin-right: 119px;">Профиль</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content">
        <h1 class="title">Передержка</h1>
        <form action="" method="post" class="choose-form">
            <select  id="select-1" class="pet-species-select search-select" name="species">
                <option value="Все" >Все</option>
                </select>
              <select  id="select-2" class="breed-select search-select" name="breed">
                <option value="Все" >Все</option>
                </select>
              <select class="city-search-select search-select" name="city">
                <option value="Все" <?= (isset($_POST['species']) && 1 == $_POST['species'])? 'selected' : ''?>>Все</option>
                <option value="Ярославль" <?= (isset($_POST['species']) && 2 == $_POST['species'])? 'selected' : ''?>>Ярославль</option>
                <option value="Москва" <?= (isset($_POST['species']) && 3 == $_POST['species'])? 'selected' : ''?>>Москва</option>
                <option value="Вологда" <?= (isset($_POST['species']) && 4 == $_POST['species'])? 'selected' : ''?>>Вологда</option>
              </select>
              <button class="search-input" name="submit">Поиск</button>
        </form>
        <div class="content__results">
            <div class="results">
                <?php
                if($ad !== null) {
                    for($i = 0; $i < 10; $i++){
                        if($i >= count($ad)) break;

                        $item = $ad[$i];
                        ?>
                <div id="<?php echo $item['id'] ?>" class="results-item" onclick="toAd(this.id)">
                    <img src="<?php echo $item['img'] ?>" alt="Фото питомца" width="258" height="212">
                    <div class="results-item__info">
                        <h2 class="info-title"><?php echo $item['title'] ?></h2>
                        <span class="description"><?php echo $item['about'] ?></span>
                        <div class="where">
                            <span class="place"><?php echo $item['city'] ?></span>
                            <span class="place-from-you"><?php echo $item['distance'] ?>м от вас</span>
                        </div>
                        <div class="price">
                            <span class="price-text">от <?php echo $item['price'] ?> руб за час</span>
                        </div>
                    </div>
                    <?php
                    if(Favs::checkFavs($item['id'], $id_user, "pethold")){
                    ?>
                       <form action="" method="post">
                           <button class="heart-btn" name="delete" value="<?php echo $item['id'] ?>" type="submit" alt="Кнопка «input»">
                               <img src="./assets/img/heart-1.svg">
                           </button>
                       </form>

                    <?php
                    } else {
                    ?>
                        <form action="" method="post">
                            <button class="heart-btn" name="add" value="<?php echo $item['id'] ?>" type="submit" alt="Кнопка «input»">
                                <img src="./assets/img/heart-2.svg">
                            </button>
                        </form>
                    <?php } ?>
                </div>
                <?php } }?>
            </div>
            <div class="favourite">
                <div class="favourite-title">
                    <h3>Избранное</h3>
                    <svg class="heart" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 0C2.239 0 0 2.216 0 4.95C0 7.157 0.875 12.395 9.488 17.69C9.64228 17.7839 9.8194 17.8335 10 17.8335C10.1806 17.8335 10.3577 17.7839 10.512 17.69C19.125 12.395 20 7.157 20 4.95C20 2.216 17.761 0 15 0C12.239 0 10 3 10 3C10 3 7.761 0 5 0Z" fill="#0099B3"/>
                    </svg>
                </div>
                <?php
                    $favs = Favs::getFavs($id_user);
                    foreach ($favs as $item) {
                ?>
                <div id="<?php echo $item['id'] ?>" class="favourite-item" onclick="toAd(this.id)">
                    <img src="<?php echo $item['img'] ?>" alt="Фото питомца" width="111" height="74">
                    <div class="fav-item__info">
                        <span class="description"><?php echo substr($item['about'],0,94).'...';  ?></span>
                        <span class="place-from-you fav-S"><?php echo $item['distance'] ?>м. от вас</span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        
    </div>
    <script>
        let species = ["Птицы", "Кошки", "Собаки", "Аквариумные животные"];
        let birds = ["Волнистые попугаи", "Совы", "Канарейки"];
        let cats = ["Персидская", "Рэгдолл ", "Мейн-кун"];
        let dogs = ["Овчарка", "Бульдог ", "Хаски"];
        let aqua = ["Рыбы", "Рептилии", "Ящерицы"];

        let slct1 = document.getElementById("select-1");
        let slct2 = document.getElementById("select-2")

        species.forEach(function addSpecies(item) {
            let option = document.createElement("option");
            option.text = item;
            option.value = item;
            slct1.appendChild(option);
        });

        slct1.onchange = function () {
            slct2.innerHTML = "<option>Все</option>";
            if (this.value == "Птицы") {
                addToSlct2(birds);
            }
            if(this.value == "Кошки") {
                addToSlct2(cats);
            };

            if(this.value == "Собаки") {
                addToSlct2(dogs);
            };

            if(this.value == "Аквариумные животные") {
                addToSlct2(aqua);
            };
        }

        function addToSlct2(arr) {
            arr.forEach(function (item) {
                let option = document.createElement("option");
                option.text = item;
                option.value = item;
                slct2.appendChild(option);
            });

        };
    </script>
    <script>
        function toAd(elem){
            let str = "ad_id=" + elem;
            document.cookie = str;
            document.cookie = "from=pethold";
            document.location.href = "./ad.html";
        }
    </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>