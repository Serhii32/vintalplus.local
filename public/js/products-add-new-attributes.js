var attributeIterator = document.getElementsByClassName('existed-attributes').length;
function addNewAttribute() {
    attributeIterator++;
    var container = document.createElement("div");
    container.setAttribute('class',"form-group py-4 border-bottom");
    container.setAttribute('id',"attribute"+attributeIterator);

    var row1 = document.createElement("div");
    row1.setAttribute('class',"row");

    var p = document.createElement("p");
    p.setAttribute('class',"text-uppercase font-weight-bold col-12 col-sm-6");

    var pText = document.createTextNode("Характеристика "+attributeIterator);
    p.appendChild(pText);

    var deleteButtonDiv = document.createElement("div");
    deleteButtonDiv.setAttribute('class',"col-12 col-sm-6");

    var deleteButton = document.createElement("a");
    deleteButton.setAttribute('class', "float-right btn btn-danger text-uppercase font-weight-bold");
    deleteButton.setAttribute('onclick', "deleteAttribute('attribute"+attributeIterator+"')");
    deleteButton.setAttribute('href', "javascript:void(0)");
    var deleteButtonText = document.createTextNode("Удалить");
    deleteButton.appendChild(deleteButtonText);

    deleteButtonDiv.appendChild(deleteButton);

    row1.appendChild(p);
    row1.appendChild(deleteButtonDiv);
    container.appendChild(row1);

    for (var langKey in languages) {
        var row2 = document.createElement("div");
        row2.setAttribute('class',"row");

        var divName = document.createElement("div");
        divName.setAttribute('class',"col-12 col-sm-6 py-2");

        var labelName = document.createElement("label");
        labelName.setAttribute('class',"text-uppercase font-weight-bold col-12");
        labelName.setAttribute('for',"attribute_name_"+langKey.toUpperCase()+"_"+attributeIterator);

        var labelNameText = document.createTextNode("Название "+langKey.toUpperCase()+":");
        labelName.appendChild(labelNameText);

        var inputName = document.createElement("input");
        inputName.setAttribute('type',"text");
        inputName.setAttribute('id',"attribute_name_"+langKey.toUpperCase()+"_"+attributeIterator+" ");
        inputName.setAttribute('name',"attributes_names"+langKey.toUpperCase()+"[]");
        inputName.setAttribute('placeholder',"Название "+langKey.toUpperCase()+":");
        inputName.setAttribute('class',"form-control autocomplete-list-target-name"+langKey.toUpperCase());

        divName.appendChild(labelName);
        divName.appendChild(inputName);

        var divValue = document.createElement("div");
        divValue.setAttribute('class',"col-12 col-sm-6 py-2");

        var labelValue = document.createElement("label");
        labelValue.setAttribute('class',"text-uppercase font-weight-bold col-12");
        labelValue.setAttribute('for',"attribute_value_"+langKey.toUpperCase()+"_"+attributeIterator);

        var labelValueText = document.createTextNode("Значение "+langKey.toUpperCase()+":");
        labelValue.appendChild(labelValueText);

        var inputValue = document.createElement("input");
        inputValue.setAttribute('type',"text");
        inputValue.setAttribute('id',"attribute_value_"+langKey.toUpperCase()+"_"+attributeIterator);
        inputValue.setAttribute('name',"attributes_values"+langKey.toUpperCase()+"[]");
        inputValue.setAttribute('placeholder',"Значение "+langKey.toUpperCase());
        inputValue.setAttribute('class',"form-control autocomplete-list-target-value"+langKey.toUpperCase());

        divValue.appendChild(labelValue);
        divValue.appendChild(inputValue);

        row2.appendChild(divName);
        row2.appendChild(divValue);

        container.appendChild(row2);
    }

    document.getElementById('productAttributes').appendChild(container);
}

function deleteAttribute(element) {
    var deletedElement = document.getElementById(element);
    document.getElementById('productAttributes').removeChild(deletedElement);
    return false;
}