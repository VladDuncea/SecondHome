function get_animal() {
    $.get('http://secondhome.fragmentedpixel.com/server/getanimals.php', function(data, status) {
        console.log(`${data}`)
    })
}