export default async (name) => {
  const { [name]: icon } = await import('@mdi/js')

  return icon
}
