import { createContext, useState } from "react";
import { Stack } from "expo-router";
import "@/global.css";
import { GluestackUIProvider } from "@/components/ui/gluestack-ui-provider";
import { StatusBar } from "expo-status-bar";

export const ColorModeContext = createContext({});

export default function RootLayout() {
  const [colorMode, setColorMode] = useState<"light" | "dark">("dark");

  return (
    <ColorModeContext.Provider value={{ colorMode, setColorMode }}>
      <GluestackUIProvider mode={colorMode}>
        <StatusBar translucent />
        <Stack>
          <Stack.Screen name="(tabs)" options={{ headerShown: false }} />
        </Stack>
      </GluestackUIProvider>
    </ColorModeContext.Provider>
  );
}
