var selectBoxModule = (function () {
    var selector = 'name';
    var parentContainer;
    var selectedItem =  undefined;
    var options = [];
    var selected; //petqa set arvi

    function init(items) {
        options = items;
        createSelectBoxContent();
    }

    function setParentEL(parentEl) {
        parentContainer = parentEl;
    }

    function setSelector(selectorName) {
        selector = selectorName;
    }

    function createSelectBoxContent() {
        var selectWrapper = document.createElement('DIV');
        selectWrapper.classList.add('select-box');
        var selectWrapperInner = document.createElement('DIV');
        selectWrapperInner.classList.add('select-inner');
        var span = document.createElement('SPAN');
        span.classList.add('placeholder');
        var placeholder = parentContainer.getAttribute('data-placeholder');
        span.innerText = placeholder;
        var arrow = document.createElement('I');
        arrow.classList.add('arrow');
        selectWrapper.appendChild(arrow);
        selectWrapperInner.appendChild(span);
        selectWrapper.appendChild(selectWrapperInner);
        parentContainer.appendChild(selectWrapper);
        createOptionWrapper();
        setSelectBoxEventListener(selectWrapper);
        // console.log(parentContainer, 'parentEl parentEl parentEl parentEl ')
    }

    function createOptionWrapper() {
        var optionWrapper = document.createElement('DIV');
        optionWrapper.classList.add('options');
        var scrollWrapper = document.createElement('DIV');
        scrollWrapper.classList.add('scroll');
        optionWrapper.appendChild(scrollWrapper);
        parentContainer.appendChild(optionWrapper);
        initOptions(options, scrollWrapper);
    }

    function initOptions(options, scrollWrapper) {
        options.forEach(function (option) {
            createOptionItem(option, scrollWrapper)
        })
    }

    function createOptionItem(itemData, scrollWrapper) {
        var option = document.createElement('P');
        option.setAttribute('id', itemData.id);
        var textNode = document.createTextNode(itemData[selector]);
        option.appendChild(textNode);
        scrollWrapper.appendChild(option);
        setOptionEventListener(option);
    }

    function setSelectBoxEventListener(selectWrapper) {
        selectWrapper.onclick = function (event) {
            closeAllOpenedSelectBoxes();
            var parentEL = getParentOfCurrentClass(event.target);
            parentEL.classList.value.indexOf('opened') > -1 ? parentEL.classList.remove('opened') : parentEL.classList.add('opened');
        }
    }
    
    function closeAllOpenedSelectBoxes() {
        var selectBoxItems = document.getElementsByClassName('def-select-box');
        Array.from(selectBoxItems).forEach(function (item) {item.classList.remove('opened')})
    }

    function getParentOfCurrentClass(element) {
        return element.parentElement.classList.value.indexOf('def-select-box') > -1 ? element.parentElement : getParentOfCurrentClass(element.parentElement)
    }

    function setOptionEventListener(option) {
        option.onclick = function (event) {
            var parent = event.target.parentElement.parentElement.parentElement;
            var valueArea = parent.querySelector('span');
                parent.classList.remove('opened');
            selectedItem = {
                id: +event.target.getAttribute('id'),
                selector: event.target.innerText
            };
            if (selectedItem) {
                // console.log('xxxxxxxxxxxxxxxxxxxxxxxxxxxxx' , selectedItem)
            }

            valueArea.innerText = selectedItem.selector;
            valueArea.classList.remove('placeholder')
        }
    }




    return {
        init: init,
        setParentEL: setParentEL,
        setSelector: setSelector,
        selected: selected
    };

})();

var selectBoxItems = document.getElementsByClassName('def-select-box');

var options = [
    {id: 1, name: '1'},
    {id: 2, name: '2'},
    {id: 3, name: '3'},
    {id: 4, name: '4'},
];


Array.from(selectBoxItems).forEach(function (selectBoxItem) {
    selectBoxModule.setParentEL(selectBoxItem);
    selectBoxModule.init(options);
});

selectBoxModule.selected = function (selected) {
    // console.log(selected, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx')
}
