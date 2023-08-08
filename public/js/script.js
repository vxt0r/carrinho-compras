const fileLabel = document.querySelector('.label-file')
const inputFile = document.querySelector('.input-file')

inputFile.addEventListener('input',()=>{
    const span = document.createElement('span')
    const br = document.createElement('br')
    const imageName = (inputFile.value).slice(12)
    span.innerText = imageName
    fileLabel.innerText = 'Substituir Imagem'
    fileLabel.append(br) 
    fileLabel.append(span)
})