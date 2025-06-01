# Sell Wave

A modern web application built with [Next.js](https://nextjs.org/) and [Catalyst UI](https://catalyst.tailwindui.com/) components.

## Features

- 🎨 **Beautiful Design** - Built with Catalyst UI components for a polished, professional look
- ♿ **Fully Accessible** - All components built with accessibility in mind using Headless UI
- 🚀 **Next.js 15** - Latest version with App Router and TypeScript support
- 🎯 **TypeScript** - Full type safety throughout the application
- 🎨 **Tailwind CSS** - Utility-first CSS framework for rapid development
- 🔥 **Hot Reload** - Fast development experience with instant updates

## Tech Stack

- **Framework**: [Next.js 15](https://nextjs.org/)
- **UI Components**: [Catalyst UI](https://catalyst.tailwindui.com/)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **UI Primitives**: [Headless UI](https://headlessui.com/)
- **Icons**: [Heroicons](https://heroicons.com/)
- **Animations**: [Framer Motion](https://www.framer.com/motion/)
- **Typography**: [Inter Font](https://rsms.me/inter/)

## Getting Started

### Prerequisites

- Node.js 18.17 or later
- npm or yarn package manager

### Installation

1. Clone the repository or use this project
2. Install dependencies:

```bash
npm install
```

3. Start the development server:

```bash
npm run dev
```

4. Open [http://localhost:3000](http://localhost:3000) in your browser

## Available Scripts

- `npm run dev` - Start development server
- `npm run build` - Build the application for production
- `npm run start` - Start the production server
- `npm run lint` - Run ESLint to check for code issues

## Project Structure

```
src/
├── app/                 # Next.js app directory
│   ├── layout.tsx      # Root layout component
│   ├── page.tsx        # Home page
│   └── globals.css     # Global styles
└── components/         # Reusable UI components
    ├── button.tsx      # Button component with variants
    ├── heading.tsx     # Typography heading component
    └── link.tsx        # Next.js router integrated link
```

## Catalyst Components

This project includes several pre-built Catalyst components:

- **Button** - Multiple variants (solid, outline, plain) with icon support
- **Heading** - Typography component with different heading levels
- **Link** - Next.js router integrated link component

## Customization

### Adding New Components

To add new Catalyst components, create them in the `src/components/` directory following the established patterns.

### Styling

This project uses Tailwind CSS with the default configuration optimized for Catalyst. The Inter font is included for consistent typography.

### Dark Mode

The project is set up for dark mode support. Components automatically adapt to the user's preference.

## Learn More

- [Catalyst UI Documentation](https://catalyst.tailwindui.com/docs)
- [Next.js Documentation](https://nextjs.org/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Headless UI Documentation](https://headlessui.com/)

## License

This project is licensed under the ISC License. 