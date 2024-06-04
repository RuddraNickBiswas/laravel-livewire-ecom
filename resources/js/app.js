import './bootstrap';

document.addEventListener('livewire:navigated', () => {

    KTMenu.init = function () {
        KTMenu.createInstances();
        KTMenu.initHandlers();
        }
    KTComponents.init();

    KTAppLayoutBuilder.init();

    // KTLayoutSearch.init();

	KTAppSidebar.init();


    KTThemeModeUser.init();


    KTThemeMode.init();


    KTApp.init();
    KTDrawer.init();
    KTMenu.init();
    KTScroll.init();
    KTSticky.init();
    KTSwapper.init();
    KTToggle.init();
    KTScrolltop.init();
    KTDialer.init();
    KTImageInput.init();
    KTPasswordMeter.init();

})
