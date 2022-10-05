Notiflix.Loading.init({
    className: 'notiflix-loading',
    zindex: 9999,
    backgroundColor: 'rgba(27,197,189,0.5)',
    rtl: false,
    fontFamily: 'Quicksand',
    cssAnimation: true,
    cssAnimationDuration: 500,
    clickToClose: false,
    customSvgUrl: null,
    customSvgCode: null,
    svgSize: '80px',
    svgColor: '#32c682',
    messageID: 'NotiflixLoadingMessage',
    messageFontSize: '15px',
    messageMaxLength: 34,
    messageColor: '#dcdcdc',
});

Notiflix.Confirm.init({
    className: 'notiflix-confirm',
    width: '300px',
    zindex: 999999,
    position: 'center', // 'center' - 'center-top' - 'center-bottom' - 'right-top' - 'right-center' - 'right-bottom' - 'left-top' - 'left-center' - 'left-bottom'
    distance: '10px',
    backgroundColor: '#f8f8f8',
    borderRadius: '25px',
    backOverlay: true,
    backOverlayColor: 'rgba(0,0,0,0.5)',
    rtl: false,
    fontFamily: 'Quicksand',
    cssAnimation: true,
    cssAnimationDuration: 300,
    cssAnimationStyle: 'fade', // 'zoom' - 'fade'
    plainText: true,

    titleColor: '#32c682',
    titleFontSize: '16px',
    titleMaxLength: 34,

    messageColor: '#1e1e1e',
    messageFontSize: '14px',
    messageMaxLength: 110,

    buttonsFontSize: '15px',
    buttonsMaxLength: 34,

    // okButtonColor: '#f8f8f8',
    // okButtonBackground: '#32c682',
    okButtonColor: '#f8f8f8',
    okButtonBackground: '#11D625',
    cancelButtonColor: '#f8f8f8',
    // cancelButtonBackground: '#a9a9a9',
    cancelButtonBackground: '#FF0000',
});

Notiflix.Notify.init({
    width: '280px',
    position: 'center-top', // 'right-top' - 'right-bottom' - 'left-top' - 'left-bottom' - 'center-top' - 'center-bottom' - 'center-center'
    distance: '30px',
    opacity: 1,
    borderRadius: '5px',
    rtl: false,
    timeout: 3000,
    messageMaxLength: 1000,
    backOverlay: false,
    backOverlayColor: 'rgba(0,0,0,1)',
    plainText: true,
    showOnlyTheLastOne: false,
    clickToClose: false,
    pauseOnHover: true,

    ID: 'NotiflixNotify',
    className: 'notiflix-notify',
    zindex: 9999999,
    fontFamily: 'Quicksand',
    fontSize: '13px',
    cssAnimation: true,
    cssAnimationDuration: 400,
    cssAnimationStyle: 'fade', // 'fade' - 'zoom' - 'from-right' - 'from-top' - 'from-bottom' - 'from-left'
    closeButton: false,
    useIcon: true,
    useFontAwesome: false,
    fontAwesomeIconStyle: 'basic', // 'basic' - 'shadow'
    fontAwesomeIconSize: '34px',

    success: {
        // background: '#32c682',
        background: '#11D625',
        textColor: '#fff',
        childClassName: 'notiflix-notify-success',
        notiflixIconColor: '#fff',
        fontAwesomeClassName: 'fas fa-check-circle',
        fontAwesomeIconColor: 'rgba(255,255,255,255.2)',
        backOverlayColor: 'rgba(50,198,130,0.9)',
    },

    failure: {
        background: '#ff5549',
        textColor: '#fff',
        childClassName: 'notiflix-notify-failure',
        notiflixIconColor: 'rgba(0,0,0,0.2)',
        fontAwesomeClassName: 'fas fa-times-circle',
        fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
        backOverlayColor: 'rgba(255,85,73,0.2)',
    },

    warning: {
        background: '#eebf31',
        textColor: '#fff',
        childClassName: 'notiflix-notify-warning',
        notiflixIconColor: 'rgba(0,0,0,0.2)',
        fontAwesomeClassName: 'fas fa-exclamation-circle',
        fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
        backOverlayColor: 'rgba(238,191,49,0.2)',
    },

    info: {
        background: '#26c0d3',
        textColor: '#fff',
        childClassName: 'notiflix-notify-info',
        notiflixIconColor: 'rgba(0,0,0,0.2)',
        fontAwesomeClassName: 'fas fa-info-circle',
        fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
        backOverlayColor: 'rgba(38,192,211,0.2)',
    },
});
