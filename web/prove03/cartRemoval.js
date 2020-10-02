document.getElementById("1delete").addEventListener("click", removeItem);

function removeItem(e) {
    const itemNum = Number(e.target.id.slice(0,1));

    let doomedItem = document.getElementById("cartItem" + itemNum);
    doomedItem.remove();
}