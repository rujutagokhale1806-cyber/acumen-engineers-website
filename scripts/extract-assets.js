const fs = require('fs');
const path = require('path');

const pdfPath = path.join(__dirname, '../assets/company-profile/Acumen Company profile.pdf');
const outDir = path.join(__dirname, '../assets/project-images');

if (!fs.existsSync(outDir)) {
    fs.mkdirSync(outDir, { recursive: true });
}

const pdf = fs.readFileSync(pdfPath);
console.log('PDF byte length:', pdf.length);

// Look for JPEG markers (FF D8 FF) and find the end of image marker (FF D9)
let count = 0;
for (let i = 0; i < pdf.length - 3; i++) {
    if (pdf[i] === 0xFF && pdf[i+1] === 0xD8 && pdf[i+2] === 0xFF) {
        for (let j = i + 10; j < pdf.length - 1; j++) {
            if (pdf[j] === 0xFF && pdf[j+1] === 0xD9) {
                const imgLen = j - i + 2;
                if (imgLen > 10000) { // Keep images larger than 10KB
                    count++;
                    const imgBuf = pdf.subarray(i, j + 2);
                    const fname = path.join(outDir, `plant-image-${count}.jpg`);
                    fs.writeFileSync(fname, imgBuf);
                    console.log(`Saved ${fname} (${imgLen} bytes)`);
                }
                i = j + 1; // Move past this JPEG
                break;
            }
        }
    }
}
console.log(`Total extracted images: ${count}`);
