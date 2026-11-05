const fs = require('fs');
const path = require('path');

const outDir = path.join(__dirname, '../assets/project-images');
for (let i = 1; i <= 4; i++) {
    const fPath = path.join(outDir, `plant-image-${i}.jpg`);
    if (fs.existsSync(fPath)) {
        const buf = fs.readFileSync(fPath);
        for (let j = 0; j < buf.length - 8; j++) {
            if (buf[j] === 0xFF && (buf[j+1] === 0xC0 || buf[j+1] === 0xC2)) {
                const h = buf.readUInt16BE(j + 5);
                const w = buf.readUInt16BE(j + 7);
                console.log(`plant-image-${i}.jpg: ${w}x${h} pixels, ${buf.length} bytes`);
                break;
            }
        }
    }
}
