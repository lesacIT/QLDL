var HandleClick = (khoa) => {
    khoa.getAttribute("class") == 'm-4 subject-box' ? khoa.setAttribute('class', 'm-4') : khoa.setAttribute('class', 'm-4 subject-box');
}