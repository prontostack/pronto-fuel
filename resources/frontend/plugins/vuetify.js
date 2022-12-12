
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg'
import colors from 'tailwindcss/colors'

const mapTailwindColor = (source, target) => {
  return {
    [`${target}-lighten-5`]: colors[source][50],
    [`${target}-lighten-4`]: colors[source][100],
    [`${target}-lighten-3`]: colors[source][200],
    [`${target}-lighten-2`]: colors[source][300],
    [`${target}-lighten-1`]: colors[source][400],
    [`${target}`]: colors[source][500],
    [`${target}-darken-1`]: colors[source][600],
    [`${target}-darken-2`]: colors[source][700],
    [`${target}-darken-3`]: colors[source][800],
    [`${target}-darken-4`]: colors[source][900]
  }
}

const lightTheme = {
  dark: false,
  colors: {
    error: colors.red[500],
    info: colors.sky[500],
    success: colors.green[600],
    warning: colors.amber[400],
    'app-bar': colors.violet[500],
    'nav-drawer-toolbar': colors.violet[800],
    ...mapTailwindColor('violet', 'primary'),
    ...mapTailwindColor('pink', 'accent')
  }
}

const darkTheme = {
  dark: true,
  colors: {
    error: colors.red[500],
    info: colors.sky[500],
    success: colors.green[600],
    warning: colors.amber[400],
    'app-bar': colors.violet[500],
    'nav-drawer-toolbar': colors.violet[700],
    ...mapTailwindColor('violet', 'primary'),
    ...mapTailwindColor('pink', 'accent')
  }
}

export default createVuetify({
  theme: {
    default: 'light',
    themes: {
      light: lightTheme,
      dark: darkTheme
    }
  },
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi
    }
  },
  defaults: {
    VCheckbox: {
      color: 'primary'
    },
    VTextField: {
      variant: 'outlined',
      color: 'primary'
    },
    VSwitch: {
      density: 'compact',
      color: 'primary',
      inset: true
    }
  },
  display: {
    mobileBreakpoint: 'md'
  }
})
