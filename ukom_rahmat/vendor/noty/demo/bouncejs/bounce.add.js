new Noty({
    type: 'success',
    theme: 'nest',
    layout: 'bottomRight',
    timeout: 3000,
    maxVisible  : 5,
    dismissQueue: true,
    progressBar : false,
    template    : 
    '<div class="r-notif"></div>',
    killer: true,
    // sounds:{
    //  sources: ['SFX/Pop Weird.wav'],
    //  volume: 1
    // }, 
    text: 'Behasil Input Data',

}).show();