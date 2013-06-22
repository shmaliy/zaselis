<div class="index-slider" id="index-slider">
        <div class="img-wrapper"><img src="/contents/img-slider.jpg" id="slider-image"></div>
        <div class="arrows-wrapper">
                <a class="arrow left" href="#"></a>
                <a class="arrow right" href="#"></a>
        </div>
        <div class="search-form-wrapper">
                <div class="title-big shadow-text">Куда Вы едете?</div>
                <div class="description shadow-text">Снимайте жилье без посредников. 4000 объектов посуточной аренды.</div>
                    <ul class="cf border-sf">
                        <li class="margin"><input id="searchTextField" type="text" class="geo" placeholder="Куда вы хотите поехать?"></li>
                        <li class="margin"><input id="inDate" type="text" class="date" placeholder="Прибытие"></li>
                        <li class="margin"><input id="outDate" type="text" class="date" placeholder="Выезд"></li>
                        <li class="margin">
                            <select id="colGuests" class="guests" placeholder="Количество гостей">
                                <option value="1" selected>1 гость</option>
                                <option value="2" >2 гостя</option>
                                <option value="3" >3 гостя</option>
                                <option value="4" >4 гостя</option>
                                <option value="5" >5 гостей</option>
                                <option value="6" >6 гостей</option>
                                <option value="7" >7 гостей</option>
                                <option value="8" >8 гостей</option>
                                <option value="9" >9 гостей</option>
                                <option value="10" >10 гостей</option>
                                <option value="11" >11 гостей</option>
                                <option value="12" >12 гостей</option>
                                <option value="13" >13 гостей</option>
                                <option value="14" >14 гостей</option>
                                <option value="15" >15 гостей</option>
                                <option value="16" >16 гостей</option>
                                <option value="16+" >16+ гостей</option>
                            </select>    
                        </li>
                        <li><input type="button" class="sfbtn" value="Поиск"></li>
                    </ul>


        </div>
        <div class="description-wrapper cf">
                <div class="text">
                        <a class="title shadow-text" href="#">Бревенчатый Дом с Панорамым Видом</a>
                        <div class="geo-desc shadow-text">Рио Негро, Аргентина, $85</div>
                </div>
                <a class="img border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
        </div>
</div>

<script>
    $("#inDate, #outDate").datepicker();
</script>