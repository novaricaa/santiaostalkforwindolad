// /netlify/functions/download.js
export async function handler(event, context) {
  // 固定下载地址（换成你的真实链接）
  const FILE_URL = 'https://santiao.oss-cn-hongkong.aliyuncs.com/santiao-x64.zip';

  const upstream = await fetch(FILE_URL, { redirect: 'follow' });
  if (!upstream.ok) {
    return { statusCode: 502, body: '无法下载指定文件' };
  }

  const filename =
    new URL(FILE_URL).pathname.split('/').pop() || 'download.bin';
  const contentType =
    upstream.headers.get('content-type') || 'application/octet-stream';

  // Netlify Functions 返回二进制需 base64
  const arrayBuf = await upstream.arrayBuffer();
  const body = Buffer.from(arrayBuf).toString('base64');

  return {
    statusCode: 200,
    headers: {
      'Content-Type': contentType,
      'Content-Disposition': `attachment; filename="${filename}"`,
      'Cache-Control': 'no-store',
    },
    body,
    isBase64Encoded: true,
  };
}
