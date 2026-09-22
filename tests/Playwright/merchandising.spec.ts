import { expect, test } from '@playwright/test';

test('standalone merchandising endpoint responds with JSON', async ({ request }) => {
  const response = await request.get('/merchandising/home');

  expect(response.status(), await response.text()).toBe(200);
  expect(response.headers()['content-type']).toContain('application/json');

  const payload = await response.json();
  expect(payload).toBeTruthy();
  expect(typeof payload).toBe('object');
});
