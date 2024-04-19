<?
session_start();
print_r($_SESSION);
?>
<header class="header">
    <div class="container">
        <nav class="header__nav">
        <ul class="header__nav-list">
        <li class="nav-list__item">
        <a class="nav-list__link" href="/catalog?CategoryID=1">Мужчинам</a>
        </li>
        <li class="nav-list__item">
        <a class="nav-list__link" href="/catalog?CategoryID=2">Женщинам</a>
        </li>
        </ul>
        <button class="header__nav-button">
        <img
        class="nav-button__image"
        src="images/header-icons/menu.svg"
        alt=""
        />
        </button>
        <a class="header__logo" href="/">
        <img
        class="header__logo-image"
        src="./images/header-icons/header_logo.svg"
        alt=""
        />
        </a>
        <ul class="header__actions-list">
            <li class="actions-list__item">
                <a class="actions-list__link" href="">
                    <img
                    class="action-list__item-image"
                    src="./images/header-icons/header__favourite-icon.svg"
                    alt=""
                    />
                </a>
            </li>
            <li class="actions-list__item">
                <a class="actions-list__link" href="/auth">
                    <img
                    class="action-list__item-image"
                    src="./images/header-icons/header__authentication-icon.svg"
                    alt=""
                    />
                </a>
            </li>
            <li class="actions-list__item">
                <a class="actions-list__link" href="/cart">
                    <img
                    class="action-list__item-image"
                    src="./images/header-icons/header__shoping-icon.svg"
                    alt=""
                    />
                </a>
            </li>
        </ul>
        </nav>
    </div>
</header>