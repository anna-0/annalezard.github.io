document.addEventListener('DOMContentLoaded', () => {
    const title = document.querySelector('#title');
    const subheading = document.querySelector('#subheading');
    let stuck = title.offsetTop;
    const copyButton = document.querySelector('#copy');
    copyButton.addEventListener('click', () =>
        copyToClipboard(document.querySelector('#email'))
    );
    copyButton.addEventListener('mouseleave', () => tooltipOut());

    const arrow = document.querySelector('#scroll');
    arrow.addEventListener('click', () => scrollTo('portfolio'));

    window.onscroll = () => {
        if (window.pageYOffset >= stuck) {
            title.className = 'stuck';
            document.querySelector('#subheading').style.display = 'none';
            document.querySelector('#arrow').style.opacity = 0;
        } 
        else if (window.pageYOffset < stuck) {
            document.querySelector('#arrow').style.opacity = 1;
            document.querySelector('#subheading').style.display = 'block';
            title.className = 'start';
        }
    };
});

function copyToClipboard(element) {
    window.getSelection().removeAllRanges();
    let range = document.createRange();
    range.selectNode(element);
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();

    const tooltip = document.querySelector('.tooltiptext');
    tooltip.innerHTML = 'Copied!';
    document.querySelector('.clipboard').style.color = '#d6eeed';
    document.querySelector('#copy').style.backgroundColor = '#1a2e34';
}

function tooltipOut() {
    document.querySelector('.tooltiptext').innerHTML = 'Copy to clipboard';
}

function scrollTo(place) {
    let url = location.href;
    location.href = '#' + place;
    history.replaceState(null, null, url);
}
